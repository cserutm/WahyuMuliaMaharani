<?php

namespace App\Http\Controllers;

use App\Models\Kuis;
use App\Models\User;
use App\Models\QuizAttempt;

class GuruDashboardController extends Controller
{
    public function index()
    {
        $kuis = Kuis::with('quizAttempts')->get();

        $labels = [];
        $averageScores = [];
        $totalAttempts = [];

        foreach ($kuis as $item) {
            $labels[] = $item->judul;
            $averageScores[] = round($item->quizAttempts->avg('score') ?? 0, 2);
            $totalAttempts[] = $item->quizAttempts->count();
        }

        $totalKuis = $kuis->count();
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalAttempt = QuizAttempt::count();

        return view('guru.dashboard', compact(
            'labels',
            'averageScores',
            'totalAttempts',
            'totalKuis',
            'totalSiswa',
            'totalAttempt'
        ));
        
    }
}