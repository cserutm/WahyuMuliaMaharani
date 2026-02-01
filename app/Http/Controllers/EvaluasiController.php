<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizAttempt;


class EvaluasiController extends Controller
{
    // 1️⃣ Halaman card kuis
    public function index()
    {
        $quizzes = Quiz::withCount('questions')->get();
        return view('siswa.evaluasi.index', compact('quizzes'));
    }

    // 2️⃣ Halaman soal
    public function show($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);

        $already = QuizAttempt::where('user_id', auth()->id())
            ->where('quiz_id', $quiz->id)
            ->exists();

        if ($already) {
            return redirect()
                ->route('siswa.evaluasi.index')
                ->with('error', 'Kuis ini sudah pernah dikerjakan');
        }

        return view('siswa.evaluasi.show', compact('quiz'));
    }

    // 3️⃣ Proses jawaban & tampilkan hasil
    public function submit(Request $request, $id)
{
    $quiz = Quiz::with('questions')->findOrFail($id);

     $already = QuizAttempt::where('user_id', auth()->id())
            ->where('quiz_id', $quiz->id)
            ->exists();

        if ($already) {
            return redirect()->route('siswa.evaluasi.index');
        }


    $correct = 0;
    $total = $quiz->questions->count();

    foreach ($quiz->questions as $q) {
        if (($request->jawaban[$q->id] ?? null) == $q->jawaban_benar) {
            $correct++;
        }
    }

    $score = $total > 0 ? round(($correct / $total) * 100) : 0;

    QuizAttempt::create([
            'user_id' => auth()->id(),
            'quiz_id' => $quiz->id,
            'score'   => $score,
            'correct' => $correct,
            'total'   => $total,
        ]);

    return view('siswa.evaluasi.result', compact('score', 'correct', 'total',));
}


}
