<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\TeacherMaterialController;
use App\Http\Middleware\EnsureRole;

/*
|--------------------------------------------------------------------------
| 1. HALAMAN PUBLIK
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome')->name('home');
Route::view('/level-view', 'level-view')->name('level-view');
Route::view('/knowledge-card', 'knowledge-card')->name('knowledge-card');
Route::redirect('/auth', '/login')->name('auth');

/*
|--------------------------------------------------------------------------
| 2. HALAMAN MATERI BAWAAN CODEPAWTH
|--------------------------------------------------------------------------
*/

Route::prefix('materi')->name('materi.')->group(function () {

    Route::view('/flashcard', 'materi.flashcard')->name('flashcard');
    Route::view('/evaluasi', 'materi.evaluasi')->name('evaluasi');
    Route::view('/flowchart', 'materi.flowchart')->name('flowchart');
    Route::view('/code', 'materi.code')->name('code');
    Route::view('/exam', 'materi.exam')->name('exam');
    Route::view('/coding', 'materi.coding')->name('coding');

});

/*
|--------------------------------------------------------------------------
| 3. AUTENTIKASI - LOGIN DAN REGISTRASI
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', fn () => view('auth', ['mode' => 'login']))->name('login');
    Route::get('/daftar', fn () => view('auth', ['mode' => 'register']))->name('register.role');

    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:8,1')->name('login.submit');
    Route::post('/daftar', [AuthController::class, 'register'])->middleware('throttle:8,1')->name('register.submit');

});

/*
|--------------------------------------------------------------------------
| 4. HALAMAN SETELAH LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Redirect berdasarkan role
    Route::get('/dashboard', fn () => match (auth()->user()->role) {
        'murid' => redirect()->route('murid.dashboard'),
        'guru'  => redirect()->route('guru.dashboard'),
        default => abort(403, 'Role pengguna tidak dikenali.'),
    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | 5. AREA MURID
    |--------------------------------------------------------------------------
    */

    Route::middleware(EnsureRole::class . ':murid')->prefix('murid')->name('murid.')->group(function () {

        // Dashboard Murid
        Route::get('/dashboard', fn () => view('murid.dashboard', ['classes' => auth()->user()->joinedClasses()->with('teacher')->get()]))->name('dashboard');

        // Belajar Mandiri
        Route::redirect('/modul', '/level-view')->name('modul');

        // Gabung Kelas Guru
        Route::post('/gabung-kelas', [ClassroomController::class, 'join'])->name('kelas.join');

    });


    /*
    |--------------------------------------------------------------------------
    | 6. AREA GURU
    |--------------------------------------------------------------------------
    */

    Route::middleware(EnsureRole::class . ':guru')->prefix('guru')->name('guru.')->group(function () {

        // Dashboard Guru
        Route::get('/dashboard', fn () => view('guru.dashboard', ['classes' => auth()->user()->teachingClasses()->withCount('students')->latest()->get()]))->name('dashboard');

        // Membuat Kelas
        Route::post('/kelas', [ClassroomController::class, 'store'])->name('kelas.store');

        // Studio Konten Guru
        Route::get('/studio-konten', fn () => view('guru.studio-konten', ['classes' => auth()->user()->teachingClasses()->orderBy('name')->get()]))->name('studio');


        /*
        |--------------------------------------------------------------------------
        | 6A. MANAJEMEN MATERI GURU
        |--------------------------------------------------------------------------
        */

        // Daftar Materi
        Route::get('/materi', [TeacherMaterialController::class, 'index'])->name('materi.index');

        // Buat Materi (Flashcard / Artikel / Foto)
        Route::get('/materi/buat/{type}', [TeacherMaterialController::class, 'create'])->whereIn('type', ['flashcard', 'artikel', 'foto', 'coding'])->name('materi.create');
        
        // Simpan Materi Baru
        Route::post('/materi', [TeacherMaterialController::class, 'store'])->name('materi.store');

        // Edit Materi
        Route::get('/materi/{material}/edit', [TeacherMaterialController::class, 'edit'])->name('materi.edit');

        // Update Materi
        Route::put('/materi/{material}', [TeacherMaterialController::class, 'update'])->name('materi.update');

    });


    /*
    |--------------------------------------------------------------------------
    | 7. MATERI BUATAN GURU UNTUK SISWA / GURU
    |--------------------------------------------------------------------------
    */

    Route::get('/belajar/materi/{material}', [TeacherMaterialController::class, 'show'])->name('materi.kelas.show');


    /*
    |--------------------------------------------------------------------------
    | 8. PENGATURAN AKUN
    |--------------------------------------------------------------------------
    */

    Route::view('/pengaturan', 'pengaturan')->name('pengaturan');

});