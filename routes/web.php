<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\Guru\QuizController;
use App\Http\Controllers\Guru\KelolaMateriController;
use App\Http\Controllers\Guru\QuestionController;
use App\Http\Controllers\Guru\ModulController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');

Route::get('/dashboard-siswa', function () {
    return view('dashboard-siswa');
})->middleware(['auth', 'role:siswa'])->name('dashboard-siswa');

    Route::get('/siswa/materi', [MateriController::class, 'index'])->name('siswa.materi.index');
    Route::get('siswa/materi/teks', [MateriController::class, 'materiTeks'])->name('siswa.materi.teks');
    Route::get('siswa/materi/video', [MateriController::class, 'materiVideo'])->name('siswa.materi.video');  

    Route::get('siswa/evaluasi', [EvaluasiController::class, 'index'])->name('siswa.evaluasi.index');
    Route::get('siswa/evaluasi/{id}', [EvaluasiController::class, 'show'])->name('siswa.evaluasi.show');
    Route::post('siswa/evaluasi/{id}', [EvaluasiController::class, 'submit'])->name('siswa.evaluasi.submit');
    

    
    Route::get('/guru/dashboard', function () {
    return view('guru.dashboard');
})->middleware(['auth', 'role:guru'])->name('guru.dashboard');
    
    Route::get('/guru/nilai_siswa', [NilaiController::class, 'nilai'])->name('guru.nilai');
    Route::get('/guru/kelola_quiz',[QuizController::class, 'index'])->name('guru.quiz.index');
    Route::post('/guru/kelola_quiz', [QuizController::class, 'store'])->name('guru.quiz.store');
    Route::get('/guru/kelola_quiz/{id}/edit', [QuizController::class, 'edit'])->name('guru.quiz.edit');
    Route::put('/guru/kelola_quiz/{id}', [QuizController::class, 'update'])->name('guru.quiz.update');
    Route::get('/kelola_quiz/create', [QuizController::class, 'create'])->name('guru.quiz.create');
    Route::delete('/guru/kelola_quiz/{id}', [QuizController::class, 'destroy'])->name('guru.quiz.destroy');

    /*
    Route::get('/guru/kelola_materi',[KelolaMateriController::class, 'index'])->name('guru.materi.index');
    Route::post('/guru/kelola_materi', [KelolaMateriController::class, 'store'])->name('guru.materi.store'); 
    Route::get('/guru/kelola_materi/create', [KelolaMateriController::class, 'create'])->name('guru.materi.create');
    Route::get('/guru/kelola_materi/{id}/edit', [KelolaMateriController::class, 'edit'])->name('guru.materi.edit');
    Route::put('/guru/kelola_materi/{id}', [KelolaMateriController::class, 'update'])->name('guru.materi.update');
    Route::delete('/guru/kelola_materi/{id}', [KelolaMateriController::class, 'destroy'])->name('guru.materi.destroy');
    */
   Route::get('/guru/materi', [ModulController::class, 'index'])
    ->name('guru.modul.index');

Route::post('/guru/materi', [ModulController::class, 'store'])
    ->name('guru.modul.store');

Route::get('/guru/materi/{id}/edit', [ModulController::class, 'edit'])
    ->name('guru.modul.edit');

    Route::put('/guru/materi/{id}', [ModulController::class, 'update'])
    ->name('guru.modul.update');


Route::get('/guru/materi/{id}', [ModulController::class, 'show'])
    ->name('guru.modul.show');


    Route::delete('/guru/materi/{id}', [ModulController::class, 'destroy'])
    ->name('guru.modul.destroy');

    Route::get('/guru/materi/{id}/download', [ModulController::class, 'download'])
    ->name('guru.modul.download');


    });




require __DIR__.'/auth.php';
