<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kuis;
use App\Models\QuizAttempt;


class EvaluasiController extends Controller
{
    public function index()
    {
        $classId = auth()->user()->class_id;

        $kuis = Kuis::where('status', 'aktif')
            ->where('class_id', $classId)
            ->withCount('pertanyaan')
            ->get();

        return view('siswa.evaluasi.index', compact('kuis'));
    }

    // 2️⃣ Halaman soal
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

    public function submit(Request $request, $id)
    {
        $classId = auth()->user()->class_id;

        $kuis = Kuis::with('pertanyaan')
            ->where('class_id', $classId)
            ->findOrFail($id);

        // cek sudah pernah mengerjakan
        $already = QuizAttempt::where('user_id', auth()->id())
            ->where('kuis_id', $kuis->id)
            ->exists();

        if ($already) {
            return redirect()->route('siswa.evaluasi.index')
                ->with('error', 'Kamu sudah mengerjakan kuis ini');
        }

        // 🔥 INI PERUBAHAN UTAMA (DRAG & DROP)
        $jawaban = json_decode($request->jawaban_data, true) ?? [];

        $correct = 0;
        $total = $kuis->pertanyaan->count();

        foreach ($kuis->pertanyaan as $q) {

            // ambil jawaban dari drag & drop
            $userAnswer = $jawaban[$q->id] ?? null;

            if ($userAnswer && $userAnswer == $q->jawaban_benar) {
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

        return view('siswa.evaluasi.result', compact('score', 'correct', 'total'));
    }
}
