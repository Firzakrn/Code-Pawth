<?php

namespace Tests\Feature;

use App\Models\LearningClass;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAndClassFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_registration_does_not_require_a_class_code(): void
    {
        $this->post('/daftar', [
            'role' => 'murid',
            'name' => 'Siswa Mandiri',
            'email' => 'siswa@example.com',
            'password' => 'SandiSiswa123',
            'password_confirmation' => 'SandiSiswa123',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'siswa@example.com', 'role' => 'murid']);
        $this->get('/murid/dashboard')->assertOk()->assertSee('Belajar Mandiri');
    }

    public function test_teacher_can_create_class_and_student_can_join_later(): void
    {
        $teacher = User::factory()->create(['role' => 'guru']);
        $student = User::factory()->create(['role' => 'murid']);

        $this->actingAs($teacher)->post('/guru/kelas', [
            'name' => 'Kelas Algoritma', 'level' => 'SMP',
        ])->assertRedirect();

        $class = LearningClass::firstOrFail();
        $this->assertSame(7, strlen($class->join_code));

        $this->actingAs($student)->get('/murid/dashboard')->assertOk();
        $this->actingAs($student)->post('/murid/gabung-kelas', [
            'join_code' => strtolower($class->join_code),
        ])->assertRedirect();

        $this->assertDatabaseHas('learning_class_user', [
            'learning_class_id' => $class->id, 'user_id' => $student->id,
        ]);
    }

    public function test_student_cannot_create_a_teacher_class(): void
    {
        $student = User::factory()->create(['role' => 'murid']);
        $this->actingAs($student)
            ->post('/guru/kelas', ['name' => 'Tidak Sah', 'level' => 'SD'])
            ->assertForbidden();
    }

    public function test_login_requires_matching_account_role(): void
    {
        User::factory()->create([
            'role' => 'guru',
            'email' => 'guru@example.com',
            'password' => 'password123',
        ]);

        $this->post('/login', [
            'role' => 'murid',
            'email' => 'guru@example.com',
            'password' => 'password123',
        ])->assertSessionHasErrors('email');
    }
}
