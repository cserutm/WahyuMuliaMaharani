<?php

namespace App\Http\Controllers;


use App\Models\QuizAttempt;

class NilaiController extends Controller
{
    public function nilai()
    {
        $attempts = QuizAttempt::with(['user', 'quiz'])
            ->orderBy('submitted_at', 'desc')
            ->get();

        return view('guru.nilai', compact('attempts'));
    }
}
