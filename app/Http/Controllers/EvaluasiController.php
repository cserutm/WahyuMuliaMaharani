<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kuis;
use App\Models\QuizAttempt;

class EvaluasiController extends Controller
{
    // 1️⃣ List kuis
    public function index()
    {
        $classId = auth()->user()->class_id;

        $kuis = Kuis::where('status', 'aktif')
            ->where('class_id', $classId)
            ->withCount('pertanyaan')
            ->get();

        return view('siswa.evaluasi.index', compact('kuis'));
    }

    // 2️⃣ Show soal
    public function show($id)
    {
        $classId = auth()->user()->class_id;

        $kuis = Kuis::with(['pertanyaan' => function ($q) {
            $q->inRandomOrder();
        }])
            ->where('class_id', $classId)
            ->findOrFail($id);

        if ($kuis->status !== 'aktif') {
            return redirect()
                ->route('siswa.evaluasi.index')
                ->with('error', 'Kuis belum tersedia');
        }

        return view('siswa.evaluasi.show', compact('kuis'));
    }

    // 3️⃣ Submit jawaban (FIX UTAMA)
    public function submit(Request $request, $id)
    {
        $classId = auth()->user()->class_id;

        $kuis = Kuis::with('pertanyaan')
            ->where('class_id', $classId)
            ->findOrFail($id);

        // ambil jawaban drag & drop
        $jawaban = json_decode($request->jawaban_data, true) ?? [];

        $correct = 0;
        $total = $kuis->pertanyaan()->count();

        foreach ($kuis->pertanyaan as $q) {
            $userAnswer = $jawaban[$q->id] ?? null;

            if ($userAnswer && $userAnswer == $q->jawaban_benar) {
                $correct++;
            }
        }

        $score = $total > 0 ? round(($correct / $total) * 100) : 0;

        //  SIMPAN HASIL (TANPA BLOCKING)
        $attempt = QuizAttempt::create([
            'user_id' => auth()->id(),
            'kuis_id' => $kuis->id,
            'score'   => $score,
            'correct' => $correct,
            'total'   => $total,
        ]);

        //  LANGSUNG KE RESULT (WAJIB)
        return view('siswa.evaluasi.result', [
            'score' => $attempt->score,
            'correct' => $attempt->correct,
            'total' => $attempt->total,
        ]);
    }
}
