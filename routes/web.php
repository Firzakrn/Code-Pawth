<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Middleware\EnsureRole;

/*
|--------------------------------------------------------------------------
| CODEPAWTH - WEB ROUTES
|--------------------------------------------------------------------------
|
| Platform Pembelajaran Pemrograman Interaktif
|
| Role:
| 1. Murid - Belajar mandiri atau bersama guru
| 2. Guru  - Mengelola kelas dan membuat konten
|
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| 1. HALAMAN PUBLIK
|--------------------------------------------------------------------------
|
| Halaman yang dapat diakses tanpa login.
|
*/

// Landing Page
Route::view('/', 'welcome')
    ->name('home');

// Peta Level Pembelajaran
Route::view('/level-view', 'level-view')
    ->name('level-view');

// Knowledge Card
Route::view('/knowledge-card', 'knowledge-card')
    ->name('knowledge-card');

// Redirect URL autentikasi lama
Route::redirect('/auth', '/login')
    ->name('auth');


/*
|--------------------------------------------------------------------------
| 2. HALAMAN MATERI DAN PEMBELAJARAN
|--------------------------------------------------------------------------
|
| Menampilkan template pembelajaran CodePawth.
|
*/

Route::prefix('materi')
    ->name('materi.')
    ->group(function () {

        // Flashcard
        Route::view('/flashcard', 'materi.flashcard')
            ->name('flashcard');

        // Evaluasi
        Route::view('/evaluasi', 'materi.evaluasi')
            ->name('evaluasi');

        // Flowchart
        Route::view('/flowchart', 'materi.flowchart')
            ->name('flowchart');

        // Code
        Route::view('/code', 'materi.code')
            ->name('code');

        // Exam
        Route::view('/exam', 'materi.exam')
            ->name('exam');

        // Coding
        Route::view('/coding', 'materi.coding')
            ->name('coding');

    });


/*
|--------------------------------------------------------------------------
| 3. LOGIN DAN REGISTRASI
|--------------------------------------------------------------------------
|
| Hanya pengguna yang belum login yang dapat
| mengakses halaman ini.
|
*/

Route::middleware('guest')
    ->group(function () {

        /*
        |--------------------------------------------------------------
        | LOGIN
        |--------------------------------------------------------------
        */

        // Halaman Login
        Route::get('/login', function () {

            return view('auth', [
                'mode' => 'login',
            ]);

        })->name('login');

        // Proses Login
        Route::post('/login', [
            AuthController::class,
            'login',
        ])
            ->middleware('throttle:8,1')
            ->name('login.submit');


        /*
        |--------------------------------------------------------------
        | REGISTRASI
        |--------------------------------------------------------------
        */

        // Halaman Daftar Siswa / Guru
        Route::get('/daftar', function () {

            return view('auth', [
                'mode' => 'register',
            ]);

        })->name('register.role');

        // Proses Registrasi
        Route::post('/daftar', [
            AuthController::class,
            'register',
        ])
            ->middleware('throttle:8,1')
            ->name('register.submit');

    });


/*
|--------------------------------------------------------------------------
| 4. HALAMAN PENGGUNA YANG SUDAH LOGIN
|--------------------------------------------------------------------------
|
| Semua route di bawah dilindungi middleware auth.
|
*/

Route::middleware('auth')
    ->group(function () {

        /*
        |--------------------------------------------------------------
        | LOGOUT
        |--------------------------------------------------------------
        */

        Route::post('/logout', [
            AuthController::class,
            'logout',
        ])->name('logout');


        /*
        |--------------------------------------------------------------
        | REDIRECT DASHBOARD BERDASARKAN ROLE
        |--------------------------------------------------------------
        */

        Route::get('/dashboard', function () {

            $user = auth()->user();

            return match ($user->role) {

                'murid' => redirect()
                    ->route('murid.dashboard'),

                'guru' => redirect()
                    ->route('guru.dashboard'),

                default => abort(
                    403,
                    'Role pengguna tidak dikenali.'
                ),

            };

        })->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | 5. AREA MURID
        |--------------------------------------------------------------------------
        |
        | Hanya pengguna dengan role murid.
        |
        */

        Route::middleware(
            EnsureRole::class . ':murid'
        )
            ->prefix('murid')
            ->name('murid.')
            ->group(function () {

                /*
                |------------------------------------------------------
                | DASHBOARD MURID
                |------------------------------------------------------
                */

                Route::get('/dashboard', function () {

                    $classes = auth()->user()
                        ->joinedClasses()
                        ->with('teacher')
                        ->get();

                    return view('murid.dashboard', [
                        'classes' => $classes,
                    ]);

                })->name('dashboard');


                /*
                |------------------------------------------------------
                | BELAJAR MANDIRI
                |------------------------------------------------------
                |
                | Murid dapat belajar tanpa kode kelas.
                |
                */

                Route::redirect(
                    '/modul',
                    '/level-view'
                )->name('modul');


                /*
                |------------------------------------------------------
                | BERGABUNG DENGAN KELAS GURU
                |------------------------------------------------------
                |
                | Kode kelas bersifat opsional.
                |
                */

                Route::post('/gabung-kelas', [
                    ClassroomController::class,
                    'join',
                ])->name('kelas.join');

            });


        /*
        |--------------------------------------------------------------------------
        | 6. AREA GURU
        |--------------------------------------------------------------------------
        |
        | Hanya pengguna dengan role guru.
        |
        */

        Route::middleware(
            EnsureRole::class . ':guru'
        )
            ->prefix('guru')
            ->name('guru.')
            ->group(function () {

                /*
                |------------------------------------------------------
                | DASHBOARD GURU
                |------------------------------------------------------
                */

                Route::get('/dashboard', function () {

                    $classes = auth()->user()
                        ->teachingClasses()
                        ->withCount('students')
                        ->orderBy('created_at', 'desc')
                        ->get();

                    return view('guru.dashboard', [
                        'classes' => $classes,
                    ]);

                })->name('dashboard');


                /*
                |------------------------------------------------------
                | MEMBUAT KELAS
                |------------------------------------------------------
                */

                Route::post('/kelas', [
                    ClassroomController::class,
                    'store',
                ])->name('kelas.store');


                /*
                |------------------------------------------------------
                | STUDIO KONTEN GURU
                |------------------------------------------------------
                |
                | Guru dapat memilih template:
                |
                | MATERI:
                | 1. Flashcard
                | 2. Tulisan + Gambar
                | 3. Foto + Penjelasan
                |
                | EVALUASI:
                | 1. Matching
                | 2. Pilih Kode Benar
                | 3. Flowchart + Preview Kode
                | 4. Coding Blocks
                |
                */

                Route::get('/studio-konten', function () {

                    $classes = auth()->user()
                        ->teachingClasses()
                        ->orderBy('name')
                        ->get();

                    return view('guru.studio-konten', [
                        'classes' => $classes,
                    ]);

                })->name('studio');

            });


        /*
        |--------------------------------------------------------------------------
        | 7. PENGATURAN AKUN
        |--------------------------------------------------------------------------
        */

        Route::view('/pengaturan', 'pengaturan')
            ->name('pengaturan');

    });