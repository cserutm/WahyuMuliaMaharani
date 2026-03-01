<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kuis;
use App\Models\QuizAttempt;


class EvaluasiController extends Controller
{
    // 1️⃣ Halaman card kuis
    public function index()
    {
        $kuis = Kuis::where('status','aktif')
        ->withCount('pertanyaan')->get();
        return view('siswa.evaluasi.index', compact('kuis'));
    }

    // 2️⃣ Halaman soal
    public function show($id)
    {
       $kuis = Kuis::with(['Pertanyaan' => function ($q) {
    $q->inRandomOrder();
    }])->findOrfail($id);

            if ($kuis->status !== 'aktif') {
        return redirect()
            ->route('siswa.evaluasi.index')
            ->with('error', 'Kuis belum tersedia');
    }

        $already = QuizAttempt::where('user_id', auth()->id())
            ->where('kuis_id', $kuis->id)
            ->exists();

        if ($already) {
            return redirect()
                ->route('siswa.evaluasi.index')
                ->with('error', 'Kuis ini sudah pernah dikerjakan');
        }

        return view('siswa.evaluasi.show', compact('kuis'));
    }

    // 3️⃣ Proses jawaban & tampilkan hasil
    public function submit(Request $request, $id)
{
    $kuis = Kuis::with('pertanyaan')->findOrFail($id);

     $already = QuizAttempt::where('user_id', auth()->id())
            ->where('kuis_id', $kuis->id)
            ->exists();

        if ($already) {
            return redirect()->route('siswa.evaluasi.index');
        }


    $correct = 0;
    $total = $kuis->pertanyaan->count();

    foreach ($kuis->pertanyaan as $q) {
        if (($request->jawaban[$q->id] ?? null) == $q->jawaban_benar) {
            $correct++;
        }
    }

    $score = $total > 0 ? round(($correct / $total) * 100) : 0;

    QuizAttempt::create([
            'user_id' => auth()->id(),
            'kuis_id' => $kuis->id,
            'score'   => $score,
            'correct' => $correct,
            'total'   => $total,
        ]);

    return view('siswa.evaluasi.result', compact('score', 'correct', 'total',));
}


}
