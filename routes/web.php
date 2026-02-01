<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\LeaderboardController;
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

Route::get('/dashboard-siswa', function () {
    return view('dashboard-siswa');
})->middleware(['auth', 'verified'])->name('dashboard-siswa');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/siswa/materi', [MateriController::class, 'index'])->name('siswa.materi.index');
    Route::get('siswa/materi/teks', [MateriController::class, 'materiTeks'])->name('siswa.materi.teks');
    Route::get('siswa/materi/video', [MateriController::class, 'materiVideo'])->name('siswa.materi.video');     
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('siswa/evaluasi', [EvaluasiController::class, 'index'])->name('siswa.evaluasi.index');
    Route::get('siswa/evaluasi/{id}', [EvaluasiController::class, 'show'])->name('siswa.evaluasi.show');
    Route::post('siswa/evaluasi/{id}', [EvaluasiController::class, 'submit'])->name('siswa.evaluasi.submit');
    Route::get('siswa/leaderboard', [LeaderboardController::class, 'index'])->name('siswa.leaderboard');


});

require __DIR__.'/auth.php';
