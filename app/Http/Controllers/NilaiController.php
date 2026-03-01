<?php

namespace App\Http\Controllers;


use App\Models\QuizAttempt;

class NilaiController extends Controller
{
    public function nilai()
    {
        $attempts = QuizAttempt::with(['user', 'kuis'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('guru.nilai', compact('attempts'));
    }
}
