<?php

namespace App\Http\Controllers;

use App\Models\LearningClass;
use App\Models\LearningMaterial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TeacherMaterialController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | JENIS TEMPLATE MATERI
    |--------------------------------------------------------------------------
    */

    private const TYPES = [
        'flashcard',
        'artikel',
        'foto',
        'coding',
    ];

    private const PYTHON_RESERVED = [
        'False', 'None', 'True', 'and', 'as', 'assert',
        'async', 'await', 'break', 'case', 'class',
        'continue', 'def', 'del', 'elif', 'else',
        'except', 'finally', 'for', 'from', 'global',
        'if', 'import', 'in', 'is', 'lambda', 'match',
        'nonlocal', 'not', 'or', 'pass', 'raise',
        'return', 'try', 'while', 'with', 'yield',
        'print', 'input', 'int', 'str', 'float',
        'bool', 'type',
    ];

    /*
    |--------------------------------------------------------------------------
    | 1. DAFTAR MATERI GURU
    |--------------------------------------------------------------------------
    */

    public function index(): View
    {
        $materials = LearningMaterial::query()
            ->where('teacher_id', Auth::id())
            ->with('learningClass:id,name')
            ->latest()
            ->get();

        return view('guru.materi-list', compact('materials'));
    }

    /*
    |--------------------------------------------------------------------------
    | 2. HALAMAN BUAT MATERI
    |--------------------------------------------------------------------------
    */

    public function create(string $type): View
    {
        abort_unless(
            in_array($type, self::TYPES, true),
            404
        );

        $view = $type === 'coding'
            ? 'guru.coding-editor'
            : 'guru.materi-editor';

        return view($view, [
            'type' => $type,
            'material' => null,
            'classes' => $this->teacherClasses(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | 3. SIMPAN MATERI BARU
    |--------------------------------------------------------------------------
    */

    public function store(Request $request): RedirectResponse
    {
        $type = (string) $request->input('type');

        abort_unless(
            in_array($type, self::TYPES, true),
            404
        );

        return $this->saveMaterial($request, $type);
    }

    /*
    |--------------------------------------------------------------------------
    | 4. HALAMAN EDIT MATERI
    |--------------------------------------------------------------------------
    */

    public function edit(LearningMaterial $material): View
    {
        $this->authorizeTeacher($material);

        abort_unless(
            in_array($material->type, self::TYPES, true),
            404
        );

        $view = $material->type === 'coding'
            ? 'guru.coding-editor'
            : 'guru.materi-editor';

        return view($view, [
            'type' => $material->type,
            'material' => $material,
            'classes' => $this->teacherClasses(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | 5. UPDATE MATERI
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        LearningMaterial $material
    ): RedirectResponse {
        $this->authorizeTeacher($material);

        abort_unless(
            in_array($material->type, self::TYPES, true),
            404
        );

        return $this->saveMaterial(
            $request,
            $material->type,
            $material
        );
    }

    /*
    |--------------------------------------------------------------------------
    | 6. PROSES PENYIMPANAN MATERI
    |--------------------------------------------------------------------------
    */

    private function saveMaterial(
        Request $request,
        string $type,
        ?LearningMaterial $material = null
    ): RedirectResponse {

        // Validasi umum
        $rules = [
            'title' => ['required', 'string', 'max:255'],

            'level' => [
                'required',
                Rule::in(['SD', 'SMP', 'SMA']),
            ],

            'status' => [
                'required',
                Rule::in(['draft', 'published']),
            ],

            'learning_class_id' => [
                'nullable',
                'required_if:status,published',
                'integer',
                Rule::exists('learning_classes', 'id')
                    ->where('teacher_id', $request->user()->id),
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | VALIDASI FLASHCARD
        |--------------------------------------------------------------------------
        */

        if ($type === 'flashcard') {

            $rules += [
                'cards' => [
                    'required',
                    'array',
                    'min:1',
                    'max:50',
                ],

                'cards.*.label' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                'cards.*.front' => [
                    'required',
                    'string',
                    'max:500',
                ],

                'cards.*.front_note' => [
                    'nullable',
                    'string',
                    'max:500',
                ],

                'cards.*.back' => [
                    'required',
                    'string',
                    'max:1000',
                ],

                'cards.*.back_note' => [
                    'nullable',
                    'string',
                    'max:500',
                ],

                'cards.*.icon' => [
                    'nullable',
                    Rule::in([
                        'monitor',
                        'keyboard',
                        'text',
                        'number',
                        'box',
                        'loop',
                        'branch',
                        'note',
                    ]),
                ],
            ];

        /*
        |--------------------------------------------------------------------------
        | VALIDASI PRAKTIK CODING PYTHON
        |--------------------------------------------------------------------------
        */

        } elseif ($type === 'coding') {

            $rules += [
                'coding' => [
                    'required',
                    'array',
                ],

                'coding.instruction' => [
                    'required',
                    'string',
                    'max:1000',
                ],

                'coding.variable' => [
                    'required',
                    'string',
                    'max:40',
                    'regex:/^[A-Za-z_][A-Za-z0-9_]*$/',
                    Rule::notIn(self::PYTHON_RESERVED),
                ],

                'coding.condition' => [
                    'required',
                    Rule::in([
                        'even',
                        'odd',
                        'gte',
                        'gt',
                        'lte',
                        'lt',
                    ]),
                ],

                'coding.threshold' => [
                    'nullable',
                    'integer',
                    'between:-1000000,1000000',
                ],

                'coding.yes_output' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'coding.no_output' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'coding.test_input' => [
                    'required',
                    'integer',
                    'between:-1000000,1000000',
                ],
            ];

        /*
        |--------------------------------------------------------------------------
        | VALIDASI ARTIKEL DAN FOTO LAMA
        |--------------------------------------------------------------------------
        */

        } else {

            $rules += [
                'blocks' => [
                    'required',
                    'array',
                    'min:1',
                    'max:20',
                ],

                'blocks.*.heading' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'blocks.*.body' => [
                    'required',
                    'string',
                    'max:10000',
                ],

                'blocks.*.caption' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'blocks.*.existing_image' => [
                    'nullable',
                    'string',
                    'max:500',
                ],

                'blocks.*.image' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:4096',
                ],
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | JALANKAN VALIDASI
        |--------------------------------------------------------------------------
        */

        $data = $request->validate($rules);

        $classId = $data['learning_class_id'] ?? null;

        // Template Coding ditujukan untuk SMP dan SMA.
        if (
            $type === 'coding' &&
            !in_array($data['level'], ['SMP', 'SMA'], true)
        ) {
            throw ValidationException::withMessages([
                'level' => 'Praktik Coding Python hanya untuk SMP atau SMA.',
            ]);
        }

        // Pastikan kelas benar-benar milik guru.
        if ($classId) {

            $class = LearningClass::query()
                ->where('teacher_id', $request->user()->id)
                ->findOrFail($classId);

            if (
                $class->level !== 'Umum' &&
                $class->level !== $data['level']
            ) {
                throw ValidationException::withMessages([
                    'level' => 'Jenjang materi harus sesuai dengan jenjang kelas.',
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SUSUN KONTEN FLASHCARD
        |--------------------------------------------------------------------------
        */

        if ($type === 'flashcard') {

            $cards = [];

            foreach ($data['cards'] as $card) {

                $cards[] = [
                    'label' => $card['label'] ?? 'Konsep Dasar',
                    'front' => $card['front'],
                    'front_note' => $card['front_note'] ?? '',
                    'back' => $card['back'],
                    'back_note' => $card['back_note'] ?? '',
                    'icon' => $card['icon'] ?? 'text',
                ];
            }

            $content = [
                'cards' => $cards,
            ];

        /*
        |--------------------------------------------------------------------------
        | SUSUN KONTEN CODING PYTHON
        |--------------------------------------------------------------------------
        */

        } elseif ($type === 'coding') {

            $coding = $data['coding'];

            $content = [
                'coding' => [
                    'instruction' => $coding['instruction'],
                    'variable' => $coding['variable'],
                    'condition' => $coding['condition'],
                    'threshold' => (int) (
                        $coding['threshold'] ?? 0
                    ),
                    'yes_output' => $coding['yes_output'],
                    'no_output' => $coding['no_output'],
                    'test_input' => (int) $coding['test_input'],
                ],
            ];

        /*
        |--------------------------------------------------------------------------
        | SUSUN KONTEN ARTIKEL / FOTO
        |--------------------------------------------------------------------------
        */

        } else {

            $allowedImages = collect(
                $material?->content['blocks'] ?? []
            )
                ->pluck('image')
                ->filter()
                ->all();

            // Validasi gambar lama dan gambar yang wajib diunggah.
            foreach ($data['blocks'] as $index => $block) {

                $existing = $block['existing_image'] ?? null;

                if (
                    $existing &&
                    !in_array($existing, $allowedImages, true)
                ) {
                    throw ValidationException::withMessages([
                        "blocks.$index.existing_image" =>
                            'Gambar lama tidak valid.',
                    ]);
                }

                if (
                    $type === 'foto' &&
                    !$existing &&
                    !$request->hasFile("blocks.$index.image")
                ) {
                    throw ValidationException::withMessages([
                        "blocks.$index.image" =>
                            'Setiap bagian Foto + Penjelasan wajib memiliki gambar.',
                    ]);
                }
            }

            $blocks = [];

            foreach ($data['blocks'] as $index => $block) {

                $imagePath = $block['existing_image'] ?? null;

                if ($request->hasFile("blocks.$index.image")) {

                    $imagePath = $request
                        ->file("blocks.$index.image")
                        ->store('learning-materials', 'public');
                }

                $blocks[] = [
                    'heading' => $block['heading'],
                    'body' => $block['body'],
                    'caption' => $block['caption'] ?? '',
                    'image' => $imagePath,
                ];
            }

            $content = [
                'blocks' => $blocks,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        if (!$material) {

            $material = new LearningMaterial();

            $material->teacher_id = $request->user()->id;
        }

        $material->fill([
            'learning_class_id' => $classId,
            'title' => $data['title'],
            'type' => $type,
            'level' => $data['level'],
            'status' => $data['status'],
            'content' => $content,
        ]);

        $material->save();

        return redirect()
            ->route('guru.materi.edit', $material)
            ->with('success', 'Materi berhasil disimpan!');
    }

    /*
    |--------------------------------------------------------------------------
    | 7. TAMPILKAN MATERI GURU
    |--------------------------------------------------------------------------
    */

    public function show(LearningMaterial $material): View
    {
        $isOwner =
            (int) $material->teacher_id === (int) Auth::id();

        $isStudentInClass =
            Auth::user()?->role === 'murid' &&
            $material->status === 'published' &&
            $material->learning_class_id !== null &&
            Auth::user()
                ->joinedClasses()
                ->where(
                    'learning_classes.id',
                    $material->learning_class_id
                )
                ->exists();

        abort_unless(
            $isOwner || $isStudentInClass,
            403
        );

        $teacherMaterial = $material;

        $lessonReturnUrl = $isOwner
            ? route('guru.materi.edit', $material)
            : route('murid.dashboard');

        /*
        |--------------------------------------------------------------
        | FLASHCARD - TAMPILAN ASLI SISWA
        |--------------------------------------------------------------
        */

        if ($material->type === 'flashcard') {

            $items = [];

            foreach (
                $material->content['cards'] ?? [] as $index => $card
            ) {
                $pairId = $index + 1;

                // Sisi depan kartu
                $items[] = [
                    'id' => $pairId * 2 - 1,
                    'pair_id' => $pairId,
                    'kategori' => 'front',
                    'judul' => $card['label'] ?: 'Konsep Dasar',
                    'main_materi' => $card['front_note'] ?? '',
                    'isi_materi' => $card['front'],
                    'iconKey' => $card['icon'] ?? 'text',
                ];

                // Sisi belakang kartu
                $items[] = [
                    'id' => $pairId * 2,
                    'pair_id' => $pairId,
                    'kategori' => 'back',
                    'judul' => 'Penjelasan Kartu',
                    'main_materi' => $card['back_note'] ?? '',
                    'isi_materi' => $card['back'],
                    'iconKey' => $card['icon'] ?? 'text',
                ];
            }

            $teacherDeck = [
                'levelTitle' => $material->title,
                'items' => $items,
            ];

            return view('materi.flashcard', compact(
                'teacherDeck',
                'teacherMaterial',
                'lessonReturnUrl'
            ));
        }

        /*
        |--------------------------------------------------------------
        | CODING PYTHON - TEMPLATE ASLI SISWA
        |--------------------------------------------------------------
        */

        if ($material->type === 'coding') {

            $teacherCoding =
                $material->content['coding'] ?? [];

            return view('materi.coding', compact(
                'teacherCoding',
                'teacherMaterial',
                'lessonReturnUrl'
            ));
        }

        /*
        |--------------------------------------------------------------
        | ARTIKEL DAN FOTO LAMA
        |--------------------------------------------------------------
        */

        abort_unless(
            in_array($material->type, ['artikel', 'foto'], true),
            404
        );

        return view(
            'materi.konten-guru',
            compact('material')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | 8. CEK KEPEMILIKAN MATERI
    |--------------------------------------------------------------------------
    */

    private function authorizeTeacher(
        LearningMaterial $material
    ): void {
        abort_unless(
            (int) $material->teacher_id === (int) Auth::id(),
            403
        );
    }

    /*
    |--------------------------------------------------------------------------
    | 9. AMBIL KELAS MILIK GURU
    |--------------------------------------------------------------------------
    */

    private function teacherClasses()
    {
        return Auth::user()
            ->teachingClasses()
            ->orderBy('name')
            ->get();
    }
}
