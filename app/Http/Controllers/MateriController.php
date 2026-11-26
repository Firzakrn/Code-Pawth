<?php

namespace App\Http\Controllers;

use App\Models\LearningClass;
use App\Models\LearningMaterial;
use App\Models\StudentLevelProgress;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use UnexpectedValueException;

class MateriController extends Controller
{
    private const DEMO_CLASS_NAME = 'Kelas Demo CodePawth';

    private const DEMO_CLASS_CODE = 'DEMOPWT';

    public function flashcard(Request $request): View
    {
        return $this->showDemoMaterial('flashcard', $request);
    }

    public function flowchart(Request $request): View
    {
        return $this->showDemoMaterial('flowchart', $request);
    }

    public function coding(Request $request): View
    {
        return $this->showDemoMaterial('coding', $request);
    }

    public function evaluasi(Request $request): View
    {
        return $this->showDemoMaterial('evaluasi', $request);
    }

    public function knowledgeCard(): View
    {
        $demoClass = LearningClass::query()
            ->where('join_code', self::DEMO_CLASS_CODE)
            ->first();

        $materials = $demoClass
            ? LearningMaterial::query()
                ->where('learning_class_id', $demoClass->id)
                ->where('status', 'published')
                ->where('type', 'flashcard')
                ->get()
            : new Collection();

        $knowledgeCardDecks = [];

        foreach ($materials as $material) {
            $levelId = (int) ($material->content['level_id'] ?? 0);
            $deckKey = "{$material->level}-{$levelId}";
            $deck = $this->makeFlashcardDeck($material);
            $deck['jenjang'] = $material->level;
            $deck['level'] = $levelId;
            $knowledgeCardDecks[$deckKey] = $deck;
        }

        $demoDeck = $knowledgeCardDecks
            ? reset($knowledgeCardDecks)
            : ['levelTitle' => self::DEMO_CLASS_NAME, 'items' => []];

        return view('knowledge-card', [
            'demoDeck' => $demoDeck,
            'knowledgeCardDecks' => $knowledgeCardDecks,
        ]);
    }

    private function showDemoMaterial(string $type, Request $request): View
    {
        $rawJenjang = $request->query('jenjang', 'SD');
        $rawLevelId = $request->query('level', '1');
        $levelId = filter_var($rawLevelId, FILTER_VALIDATE_INT);

        abort_unless(
            is_string($rawJenjang) &&
            is_int($levelId) &&
            in_array(strtoupper($rawJenjang), ['SD', 'SMP', 'SMA'], true) &&
            $levelId >= 1 &&
            $levelId <= 5,
            404
        );

        $jenjang = strtoupper($rawJenjang);
        $demoClass = LearningClass::query()
            ->where('join_code', self::DEMO_CLASS_CODE)
            ->first();

        $materials = $demoClass
            ? LearningMaterial::query()
                ->where('learning_class_id', $demoClass->id)
                ->where('status', 'published')
                ->where('level', $jenjang)
                ->whereIn('type', ['flashcard', 'flowchart', 'coding'])
                ->get()
            : new Collection();

        $flashcardMaterial = $this->findMaterial($materials, 'flashcard', $levelId);
        $flowchartMaterial = $this->findMaterial($materials, 'flowchart', $levelId);
        $codingMaterial = $this->findMaterial($materials, 'coding', $levelId);
        $demoDeck = $this->makeFlashcardDeck($flashcardMaterial);
        $flowchartChallenge = $this->makeFlowchartChallenge($flowchartMaterial);
        $codingMaterialData = $codingMaterial?->content;

        if ($codingMaterialData !== null) {
            $codingMaterialData['outputRule'] = $this->codingOutputRule($codingMaterialData);
        }

        $demoContentAvailable = match ($type) {
            'flashcard', 'evaluasi' => count($demoDeck['items']) > 0,
            'flowchart' => $flowchartChallenge !== null,
            'coding' => $codingMaterial !== null,
            default => false,
        };

        return view('materi.' . $type, [
            'isDemoPreview' => true,
            'demoContentAvailable' => $demoContentAvailable,
            'demoClassName' => $demoClass?->name ?? self::DEMO_CLASS_NAME,
            'demoClassCode' => self::DEMO_CLASS_CODE,
            'demoJenjang' => $jenjang,
            'demoLevelId' => $levelId,
            'demoHasFlowchart' => $flowchartChallenge !== null,
            'demoHasCoding' => $codingMaterial !== null,
            'demoDeck' => $demoDeck,
            'flowchartChallenge' => $flowchartChallenge,
            'codingMaterial' => $codingMaterialData,
            'canSaveProgress' => Auth::user()?->isStudent() ?? false,
        ]);
    }

    private function findMaterial(
        Collection $materials,
        string $type,
        int $levelId
    ): ?LearningMaterial {
        return $materials->first(
            static fn (LearningMaterial $material): bool =>
                $material->type === $type &&
                (int) ($material->content['level_id'] ?? 0) === $levelId
        );
    }

    private function makeFlashcardDeck(?LearningMaterial $material): array
    {
        if (!$material) {
            return [
                'levelTitle' => self::DEMO_CLASS_NAME,
                'items' => [],
            ];
        }

        $items = [];

        foreach ($material->content['cards'] as $card) {
            $pairId = (int) $card['pair_id'];

            $items[] = [
                'id' => $pairId * 2 - 1,
                'pair_id' => $pairId,
                'kategori' => 'front',
                'judul' => $card['front_judul'],
                'main_materi' => $card['front_main_materi'],
                'isi_materi' => $card['front_isi_materi'],
                'iconKey' => $card['iconKey'] ?? 'default',
            ];

            $items[] = [
                'id' => $pairId * 2,
                'pair_id' => $pairId,
                'kategori' => 'back',
                'judul' => $card['back_judul'],
                'main_materi' => $card['back_main_materi'],
                'isi_materi' => $card['back_isi_materi'],
                'iconKey' => $card['iconKey'] ?? 'default',
            ];
        }

        return [
            'levelTitle' => $material->title,
            'items' => $items,
        ];
    }

    private function makeFlowchartChallenge(?LearningMaterial $material): ?array
    {
        if (!$material) {
            return null;
        }

        $content = $material->content;
        $slots = [];

        foreach (['step1', 'decision', 'branchYes', 'branchNo'] as $slot) {
            $prefix = 'slot_' . $slot;
            $slots[$slot] = [
                'expected' => $content[$prefix . '_expected'],
                'filledSub' => $content[$prefix . '_filledSub'],
            ];
        }

        return [
            'questionHtml' => $content['question_html'],
            'slots' => $slots,
        ];
    }

    private function codingOutputRule(array $codingMaterial): array
    {
        $sample = $codingMaterial['decision_sample'];

        if (preg_match('/%\s*(\d+)\s*==\s*0\s*$/', $sample, $matches)) {
            return [
                'operator' => 'modulo-zero',
                'operand' => (int) $matches[1],
            ];
        }

        if (preg_match('/(>=|<=|>|<)\s*(-?\d+)\s*$/', $sample, $matches)) {
            return [
                'operator' => $matches[1],
                'operand' => (int) $matches[2],
            ];
        }

        throw new UnexpectedValueException(
            'Format kondisi coding demo tidak dikenali.'
        );
    }

    public function levelView(): View
    {
        $user = Auth::user();
        $canSaveProgress = $user?->isStudent() ?? false;
        $demoClass = LearningClass::query()
            ->where('join_code', self::DEMO_CLASS_CODE)
            ->first();

        $materials = $demoClass
            ? LearningMaterial::query()
                ->where('learning_class_id', $demoClass->id)
                ->where('status', 'published')
                ->whereIn('type', ['flashcard', 'flowchart', 'coding'])
                ->get()
            : new Collection();

        $demoLevels = [];

        foreach ($materials->where('type', 'flashcard') as $material) {
            $jenjang = strtoupper($material->level);
            $levelId = (int) ($material->content['level_id'] ?? 0);
            $cards = $material->content['cards'] ?? [];
            $levelMaterials = $materials->where('level', $jenjang);
            $availableTypes = ['Flashcard'];

            foreach (['flowchart', 'coding'] as $type) {
                if ($this->findMaterial($levelMaterials, $type, $levelId)) {
                    $availableTypes[] = ucfirst($type);
                }
            }

            $demoLevels[$jenjang][] = [
                'id' => $levelId,
                'language' => 'Materi: ' . implode(' + ', $availableTypes),
                'title' => $material->title,
                'description' => 'Materi demo berisi ' . count($cards) . ' pasangan kartu flashcard.',
                'topics' => array_values(array_filter(array_map(
                    static fn (array $card): ?string => $card['front_isi_materi'] ?? null,
                    $cards
                ))),
                'status' => 'locked',
                'score' => 0,
                'stars' => 0,
                'progress' => 0,
                'cardsDone' => count($cards) . ' Pasangan Kartu',
                'adaptiveNote' => 'Selesaikan evaluasi dengan nilai minimal 80 untuk membuka level berikutnya.',
                'url' => url('/materi/flashcard'),
            ];
        }

        foreach ($demoLevels as &$levels) {
            usort($levels, static fn (array $first, array $second): int => $first['id'] <=> $second['id']);
        }
        unset($levels);

        $serverProgress = $canSaveProgress
            ? $user
                ->studentLevelProgresses()
                ->where('class_code', self::DEMO_CLASS_CODE)
                ->get(['jenjang', 'level_id', 'score', 'stars'])
            : collect();

        return view('level-view', [
            'canSaveProgress' => $canSaveProgress,
            'serverProgress' => $serverProgress,
            'demoLevels' => $demoLevels,
        ]);
    }

    public function storeProgress(Request $request): JsonResponse
    {
        $student = $request->user();
        abort_unless($student && $student->isStudent(), 403);

        $data = $request->validate([
            'jenjang' => [
                'required',
                Rule::in(['SD', 'SMP', 'SMA']),
            ],
            'level_id' => [
                'required',
                'integer',
                'between:1,100',
            ],
            'score' => [
                'required',
                'integer',
                'between:80,100',
            ],
            'stars' => [
                'required',
                'integer',
                'between:2,3',
            ],
        ]);

        $progress = StudentLevelProgress::query()->firstOrNew([
            'user_id' => $student->id,
            'class_code' => self::DEMO_CLASS_CODE,
            'jenjang' => $data['jenjang'],
            'level_id' => $data['level_id'],
        ]);

        $progress->score = max((int) $progress->score, $data['score']);
        $progress->stars = max((int) $progress->stars, $data['stars']);
        $progress->completed_at = now();
        $progress->save();

        return response()->json([
            'message' => 'Progres berhasil disimpan.',
            'progress' => $progress->only([
                'jenjang',
                'level_id',
                'score',
                'stars',
            ]),
        ]);
    }
}
