<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use App\Models\Classes;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    // 👩‍🏫 GURU (ADA FILTER)
    public function guru()
    {
        $classId = request('class_id');

        $leaderboard = QuizAttempt::select(
                'user_id',
                DB::raw('SUM(score) as total_score'),
                DB::raw('COUNT(*) as total_quiz')
            )
            ->with(['user.kelas'])
            ->when($classId, function ($q) use ($classId) {
                $q->whereHas('user', function ($query) use ($classId) {
                    $query->where('class_id', $classId);
                });
            })
            ->groupBy('user_id')
            ->orderByDesc('total_score')
            ->get();

        // 🔥 untuk dropdown filter
        $classes = Classes::all();

        return view('guru.leaderboard', compact('leaderboard', 'classes', 'classId'));
    }

    // 👨‍🎓 SISWA (HANYA KELAS SENDIRI)
    public function siswa()
    {
        $user = auth()->user();

        $leaderboard = QuizAttempt::select(
                'user_id',
                DB::raw('SUM(score) as total_score'),
                DB::raw('COUNT(*) as total_quiz')
            )
            ->with(['user.kelas'])
            ->whereHas('user', function ($query) use ($user) {
                $query->where('class_id', $user->class_id);
            })
            ->groupBy('user_id')
            ->orderByDesc('total_score')
            ->get();

        return view('siswa.leaderboard', compact('leaderboard'));
    }
}