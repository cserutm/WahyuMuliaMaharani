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
use App\Http\Controllers\Guru\SemesterController;
use App\Http\Controllers\Guru\ClassController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotifikasiController;
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

    Route::post('/komentar', [CommentController::class, 'store'])
        ->name('komentar.store');
    Route::get('/notif/read/{id}', [NotifikasiController::class, 'read'])->name('notif.read');
    Route::get('/notif/read-all', [NotifikasiController::class, 'readAll'])->name('notif.readAll');


    Route::middleware(['auth', 'role:siswa', 'check.semester'])->group(function () {
        Route::get('/siswa/dashboard', [DashboardSiswaController::class, 'index'])
            ->name('dashboard-siswa');
    });


    Route::get('/semester-nonaktif', function () {
        return view('siswa.semester');
    })->name('siswa.semester');

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
    Route::get('/guru/nilai/export', [NilaiController::class, 'export'])->name('nilai.export');

    Route::get('guru/semester', [SemesterController::class, 'index'])->name('guru.semester.index');
    Route::post('guru/semester', [SemesterController::class, 'store'])->name('guru.semester.store');
    Route::put('/guru/semester/{id}', [SemesterController::class, 'update'])->name('guru.semester.update');
    Route::delete('/guru/semester/{id}', [SemesterController::class, 'destroy'])->name('guru.semester.destroy');
    Route::post('/guru/semester/{id}/activate', [SemesterController::class, 'activate'])->name('guru.semester.activate');
    Route::post('/guru/semester/{id}/deactivate', [SemesterController::class, 'deactivate'])->name('guru.semester.deactivate');


    Route::get('guru/classes', [ClassController::class, 'index'])->name('guru.classes.index');
    Route::post('guru/classes', [ClassController::class, 'store'])->name('guru.classes.store');
    Route::put('/guru/classes/{id}', [ClassController::class, 'update'])->name('guru.classes.update');
    Route::delete('/guru/classes/{id}', [ClassController::class, 'destroy'])->name('guru.classes.destroy');


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


    Route::get(
        '/guru/kuis/{kuis_id}/pertanyaan',
        [PertanyaanController::class, 'index']
    )->name('guru.kuis.pertanyaan.index');

    Route::post(
        '/guru/kuis/{kuis_id}/pertanyaan',
        [PertanyaanController::class, 'store']
    )->name('guru.kuis.pertanyaan.store');

    Route::get(
        '/guru/kuis/{kuis_id}/pertanyaan/{id}/edit',
        [PertanyaanController::class, 'edit']
    )->name('guru.kuis.pertanyaan.edit');

    Route::put(
        '/guru/kuis/{kuis_id}/pertanyaan/{id}',
        [PertanyaanController::class, 'update']
    )->name('guru.kuis.pertanyaan.update');

    Route::delete(
        '/guru/kuis/{kuis_id}/pertanyaan/{id}',
        [PertanyaanController::class, 'destroy']
    )->name('guru.kuis.pertanyaan.destroy');

    Route::prefix('guru')->name('guru.')->middleware(['auth'])->group(function () {
        Route::get('/leaderboard', [LeaderboardController::class, 'guru'])
            ->name('leaderboard');
    });
});




require __DIR__ . '/auth.php';
