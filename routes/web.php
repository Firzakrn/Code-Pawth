<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('level-view', function () {
    return view('level-view');
})->name('level-view');
Route::view('/auth', 'auth')->name('auth');
Route::view('/materi/flashcard', 'materi.flashcard')->name('materi.flashcard');
Route::view('/materi/evaluasi', 'materi.evaluasi')->name('materi.evaluasi');
Route::view('/materi/flowchart', 'materi.flowchart')->name('materi.flowchart');
Route::view('/materi/code', 'materi.code')->name('materi.code');
Route::view('/materi/exam', 'materi.exam')->name('materi.exam');
Route::view('/materi/coding', 'materi.coding');
Route::view('/knowledge-card', 'knowledge-card')->name('knowledge-card');
Route::view('/pengaturan', 'pengaturan')->name('pengaturan');


