<?php

namespace Tests\Feature;

use App\Models\StudentLevelProgress;
use App\Models\User;
use Database\Seeders\DemoCodePawthSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MateriControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_open_demo_material_pages_without_material_data(): void
    {
        foreach (['flashcard', 'flowchart', 'coding', 'evaluasi'] as $type) {
            $this->get(route('materi.' . $type))
                ->assertOk()
                ->assertSee('Materi demo belum tersedia')
                ->assertSee('Masuk untuk menyimpan progres')
                ->assertDontSee('saveLevelCompletion');
        }
    }

    public function test_guest_can_access_published_demo_material_from_the_database(): void
    {
        $this->seed(DemoCodePawthSeeder::class);

        $this->assertGuest();

        $this->get(route('materi.flashcard', ['jenjang' => 'SD', 'level' => 1]))
            ->assertOk()
            ->assertSee('Cita-Cita Teknologi')
            ->assertDontSee('Materi demo belum tersedia');

        $this->get(route('materi.evaluasi', ['jenjang' => 'SD', 'level' => 1]))
            ->assertOk()
            ->assertSee('Cita-Cita Teknologi')
            ->assertSee('0 / 5')
            ->assertDontSee('Materi demo belum tersedia');

        $this->get(route('materi.flowchart', ['jenjang' => 'SMP', 'level' => 1]))
            ->assertOk()
            ->assertSee('Input bilangan')
            ->assertDontSee('Materi demo belum tersedia');

        $this->get(route('materi.coding', ['jenjang' => 'SMA', 'level' => 1]))
            ->assertOk()
            ->assertSee('bilangan % 2 == 0')
            ->assertDontSee('Materi demo belum tersedia');
    }

    public function test_knowledge_cards_use_the_seeded_demo_flashcards(): void
    {
        $this->seed(DemoCodePawthSeeder::class);

        $this->get(route('knowledge-card'))
            ->assertOk()
            ->assertSee('Cita-Cita Teknologi')
            ->assertDontSee('Fungsi Output');
    }

    public function test_level_map_uses_seeded_flashcard_levels_and_topics(): void
    {
        $this->seed(DemoCodePawthSeeder::class);

        $this->get(route('level-view'))
            ->assertOk()
            ->assertSee('SD Level 1')
            ->assertDontSee('Kenalan dengan Python')
            ->assertViewHas('demoLevels', function (array $demoLevels): bool {
                return count($demoLevels['SD']) === 5
                    && $demoLevels['SD'][0]['title'] === 'SD Level 1'
                    && $demoLevels['SD'][0]['topics'][0] === 'Programmer';
            });
    }

    public function test_guest_cannot_store_demo_progress(): void
    {
        $this->post(route('materi.progress.store'), [
            'jenjang' => 'SMP',
            'level_id' => 1,
            'score' => 90,
            'stars' => 3,
        ])->assertRedirect(route('login'));

        $this->assertDatabaseCount('student_level_progresses', 0);
    }

    public function test_student_can_store_and_load_demo_progress(): void
    {
        $student = User::factory()->create(['role' => 'murid']);

        $this->actingAs($student)
            ->postJson(route('materi.progress.store'), [
                'jenjang' => 'SMP',
                'level_id' => 2,
                'score' => 90,
                'stars' => 3,
            ])
            ->assertOk()
            ->assertJsonPath('message', 'Progres berhasil disimpan.');

        $this->assertDatabaseHas('student_level_progresses', [
            'user_id' => $student->id,
            'class_code' => 'DEMOPWT',
            'jenjang' => 'SMP',
            'level_id' => 2,
            'score' => 90,
            'stars' => 3,
        ]);

        $this->actingAs($student)
            ->get(route('level-view'))
            ->assertOk()
            ->assertViewHas('serverProgress', function ($progress): bool {
                return $progress->contains(
                    fn (StudentLevelProgress $item): bool => $item->jenjang === 'SMP'
                        && $item->level_id === 2
                        && $item->score === 90
                );
            });
    }

    public function test_teacher_cannot_store_student_progress(): void
    {
        $teacher = User::factory()->create(['role' => 'guru']);

        $this->actingAs($teacher)
            ->postJson(route('materi.progress.store'), [
                'jenjang' => 'SMP',
                'level_id' => 1,
                'score' => 90,
                'stars' => 3,
            ])
            ->assertForbidden();

        $this->assertDatabaseCount('student_level_progresses', 0);
    }

    public function test_student_cannot_save_a_failing_evaluation_as_completed(): void
    {
        $student = User::factory()->create(['role' => 'murid']);

        $this->actingAs($student)
            ->postJson(route('materi.progress.store'), [
                'jenjang' => 'SMP',
                'level_id' => 1,
                'score' => 79,
                'stars' => 1,
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['score', 'stars']);

        $this->assertDatabaseCount('student_level_progresses', 0);
    }
}
