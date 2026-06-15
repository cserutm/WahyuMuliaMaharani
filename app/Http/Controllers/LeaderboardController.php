<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use App\Models\Classes;
use App\Models\Kuis;
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

        $totalKuis = Kuis::count();

        foreach ($leaderboard as $row) {

            $row->average_score =
                $row->total_quiz > 0
                ? round($row->total_score / $row->total_quiz, 2)
                : 0;

            $row->progress =
                $totalKuis > 0
                ? round(($row->total_quiz / $totalKuis) * 100)
                : 0;
        }

        $classes = Classes::all();

        return view(
            'guru.leaderboard',
            compact(
                'leaderboard',
                'classes',
                'classId',
                'totalKuis'
            )
        );
    }

    // 👨‍🎓 SISWA (HANYA KELAS SENDIRI)
    public function siswa()
    {
        $user = auth()->user();

        $totalKuis = Kuis::count();

        $kuisSelesai = QuizAttempt::where(
            'user_id',
            $user->id
        )->count();

        $totalScore = QuizAttempt::where(
            'user_id',
            $user->id
        )->sum('score');

        $averageScore = $kuisSelesai > 0
            ? round($totalScore / $kuisSelesai, 2)
            : 0;

        $progress = $totalKuis > 0
            ? round(($kuisSelesai / $totalKuis) * 100)
            : 0;

        return view(
            'siswa.progress',
            compact(
                'totalKuis',
                'kuisSelesai',
                'totalScore',
                'averageScore',
                'progress'
            )
        );
    }
}
