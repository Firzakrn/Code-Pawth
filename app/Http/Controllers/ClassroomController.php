<?php

namespace App\Http\Controllers;

use App\Models\LearningClass;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class ClassroomController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],
            'level' => [
                'required',
                'in:SD,SMP,SMA,Umum',
            ],
        ]);

        do {
            $code = Str::upper(Str::random(7));
        } while (
            LearningClass::where('join_code', $code)->exists()
        );

        $request->user()->teachingClasses()->create([
            'name' => $data['name'],
            'level' => $data['level'],
            'join_code' => $code,
        ]);

        return back()->with(
            'success',
            'Kelas berhasil dibuat! Kode: ' . $code
        );
    }

    public function join(Request $request): RedirectResponse
    {
        $request->merge([
            'join_code' => Str::upper(
                trim((string) $request->input('join_code'))
            ),
        ]);

        $data = $request->validate([
            'join_code' => [
                'required',
                'alpha_num',
                'size:7',
            ],
        ]);

        $class = LearningClass::where(
            'join_code',
            $data['join_code']
        )->first();

        if (!$class) {
            return back()
                ->withErrors([
                    'join_code' => 'Kode kelas tidak ditemukan.'
                ])
                ->withInput();
        }

        $alreadyJoined = $request->user()
            ->joinedClasses()
            ->where('learning_classes.id', $class->id)
            ->exists();

        if ($alreadyJoined) {
            return back()->with(
                'success',
                'Kamu sudah bergabung di kelas ini.'
            );
        }

        $request->user()
            ->joinedClasses()
            ->attach($class->id);

        return back()->with(
            'success',
            'Berhasil bergabung ke kelas ' . $class->name
        );
    }
}