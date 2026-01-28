<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\EvaluasiController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
    Route::get('/materi/teks', [MateriController::class, 'materiTeks'])->name('materi.teks');
    Route::get('/materi/video', [MateriController::class, 'materiVideo'])->name('materi.video');     
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/evaluasi', [EvaluasiController::class, 'index'])->name('evaluasi.index');
    Route::get('/evaluasi/{id}', [EvaluasiController::class, 'show'])->name('evaluasi.show');
    Route::post('/evaluasi/{id}', [EvaluasiController::class, 'submit'])->name('evaluasi.submit');


});

require __DIR__.'/auth.php';
