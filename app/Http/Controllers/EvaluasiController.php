<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class EvaluasiController extends Controller
{
    // 1️⃣ Halaman card kuis
    public function index()
    {
        $quizzes = Quiz::withCount('questions')->get();
        return view('evaluasi.index', compact('quizzes'));
    }

    // 2️⃣ Halaman soal
    public function show($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        return view('evaluasi.show', compact('quiz'));
    }

    // 3️⃣ Proses jawaban & tampilkan hasil
    public function submit(Request $request, $id)
{
    $quiz = Quiz::with('questions')->findOrFail($id);

    $correct = 0;
    $total = $quiz->questions->count();

    foreach ($quiz->questions as $q) {
        if (($request->jawaban[$q->id] ?? null) == $q->jawaban_benar) {
            $correct++;
        }
    }

    $score = $total > 0 ? round(($correct / $total) * 100) : 0;

    // warna berdasarkan nilai
    if ($score >= 80) {
        $color = 'green';
    } elseif ($score >= 60) {
        $color = 'blue';
    } elseif ($score >= 40) {
        $color = 'yellow';
    } else {
        $color = 'red';
    }

    return view('evaluasi.result', compact('score', 'correct', 'total', 'color'));
}


}
