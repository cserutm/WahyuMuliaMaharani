<?php
namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function guru()
    {
        $leaderboard = QuizAttempt::select(
                'user_id',
                DB::raw('SUM(score) as total_score'),
                DB::raw('COUNT(*) as total_quiz')
            )
            ->with('user')
            ->groupBy('user_id')
            ->orderByDesc('total_score')
            ->get();

        return view('guru.leaderboard', compact('leaderboard'));
    }

public function siswa()
{
   $leaderboard = QuizAttempt::select(
                'user_id',
                DB::raw('SUM(score) as total_score'),
                DB::raw('COUNT(*) as total_quiz')
            )
            ->with('user')
            ->groupBy('user_id')
            ->orderByDesc('total_score')
            ->get();

        return view('siswa.leaderboard', compact('leaderboard'));
    
}
}
