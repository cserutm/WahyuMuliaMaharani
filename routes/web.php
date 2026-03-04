<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\Guru\QuizController;
use App\Http\Controllers\Guru\KelolaMateriController;
use App\Http\Controllers\Guru\QuestionController;
use App\Http\Controllers\Guru\ModulController;
use App\Http\Controllers\Guru\VideoController;
use App\Http\Controllers\Guru\MateriGuruController;
use App\Http\Controllers\Guru\KuisController;
use App\Http\Controllers\Guru\PertanyaanController;
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\SiswaMateriController;
use App\Http\Controllers\DashboardSiswaController;
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


Route::get('/siswa/dashboard', [DashboardSiswaController::class, 'index'])
    ->middleware(['auth', 'role:siswa'])
    ->name('dashboard-siswa');

    Route::get('/siswa/materi', [SiswaMateriController::class, 'index'])->name('siswa.materi.index');
    Route::get('siswa/materi/file', [SiswaMateriController::class, 'modul'])->name('siswa.materi.modul');
    Route::get('siswa/materi_file/{id}/download', [SiswaMateriController::class, 'download'])
    ->name('siswa.modul.download');
    Route::get('siswa/materi/video', [SiswaMateriController::class, 'video'])->name('siswa.materi.video');  

    Route::get('siswa/evaluasi', [EvaluasiController::class, 'index'])->name('siswa.evaluasi.index');
    Route::get('siswa/evaluasi/{id}', [EvaluasiController::class, 'show'])->name('siswa.evaluasi.show');
    Route::post('siswa/evaluasi/{id}', [EvaluasiController::class, 'submit'])->name('siswa.evaluasi.submit');

    Route::prefix('siswa')->name('siswa.')->middleware(['auth'])->group(function () {
    Route::get('/leaderboard', [LeaderboardController::class, 'siswa'])
        ->name('leaderboard');
});
    


Route::get('/guru/dashboard', [GuruDashboardController::class, 'index'])
    ->middleware(['auth', 'role:guru'])
    ->name('guru.dashboard');
    
    Route::get('/guru/nilai_siswa', [NilaiController::class, 'nilai'])->name('guru.nilai');


    Route::get('/guru/materi', [MateriGuruController::class, 'index'])
    ->name('guru.materi');
    Route::get('/guru/materi_file', [ModulController::class, 'index'])
    ->name('guru.modul.index');
    Route::post('/guru/materi_file', [ModulController::class, 'store'])
    ->name('guru.modul.store');
    Route::get('/guru/materi_file/{id}/edit', [ModulController::class, 'edit'])
    ->name('guru.modul.edit');
    Route::put('/guru/materi_file/{id}', [ModulController::class, 'update'])
    ->name('guru.modul.update');
    Route::get('/guru/materi_file/{id}', [ModulController::class, 'show'])
    ->name('guru.modul.show');
    Route::delete('/guru/materi_file/{id}', [ModulController::class, 'destroy'])
    ->name('guru.modul.destroy');
    Route::get('/guru/materi_file/{id}/download', [ModulController::class, 'download'])
    ->name('guru.modul.download');




    Route::get('/guru/materi_video', [VideoController::class, 'index'])
    ->name('guru.video.index');
    Route::post('/guru/materi_video', [VideoController::class, 'store'])
    ->name('guru.video.store');
    Route::get('/guru/materi_video/{id}/edit', [VideoController::class, 'edit'])
    ->name('guru.video.edit');
    Route::put('/guru/materi_video/{id}', [VideoController::class, 'update'])
    ->name('guru.video.update');
    Route::get('/guru/materi_video/{id}', [VideoController::class, 'show'])
    ->name('guru.video.show');
    Route::delete('/guru/materi_video/{id}', [VideoController::class, 'destroy'])
    ->name('guru.video.destroy');

    Route::get('/guru/kuis', [KuisController::class, 'index'])
    ->name('guru.kuis.index');
     Route::post('/guru/kuis', [KuisController::class, 'store'])
    ->name('guru.kuis.store');
     Route::get('/guru/kuis/{id}/edit', [KuisController::class, 'edit'])
    ->name('guru.kuis.edit');
     Route::put('/guru/kuis/{id}', [KuisController::class, 'update'])
    ->name('guru.kuis.update');
    Route::get('/guru/kuis/{id}', [KuisController::class, 'show'])
    ->name('guru.kuis.show');
    Route::delete('/guru/kuis/{id}', [KuisController::class, 'destroy'])
    ->name('guru.kuis.destroy');

     
    Route::get('/guru/kuis/{kuis_id}/pertanyaan', 
    [PertanyaanController::class, 'index']
)->name('guru.kuis.pertanyaan.index');

Route::post('/guru/kuis/{kuis_id}/pertanyaan', 
    [PertanyaanController::class, 'store']
)->name('guru.kuis.pertanyaan.store');

Route::get('/guru/kuis/{kuis_id}/pertanyaan/{id}/edit', 
    [PertanyaanController::class, 'edit']
)->name('guru.kuis.pertanyaan.edit');

Route::put('/guru/kuis/{kuis_id}/pertanyaan/{id}', 
    [PertanyaanController::class, 'update']
)->name('guru.kuis.pertanyaan.update');

Route::delete('/guru/kuis/{kuis_id}/pertanyaan/{id}', 
    [PertanyaanController::class, 'destroy']
)->name('guru.kuis.pertanyaan.destroy');

Route::prefix('guru')->name('guru.')->middleware(['auth'])->group(function () {
    Route::get('/leaderboard', [LeaderboardController::class, 'guru'])
        ->name('leaderboard');
});

    



    });




require __DIR__.'/auth.php';
