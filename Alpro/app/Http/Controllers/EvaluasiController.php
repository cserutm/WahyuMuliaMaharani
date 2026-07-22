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

        // =========================
        // NORMALISASI SAJA (TIDAK FILTER)
        // =========================
        $kuis->pertanyaan = $kuis->pertanyaan->map(function ($q) {
            $q->label = strtoupper(trim($q->label ?? ''));
            return $q;
        });

        return view('siswa.evaluasi.show', compact('kuis'));
    }
    public function submit(Request $request, $id)
    {
        $classId = auth()->user()->class_id;

        $kuis = Kuis::with('pertanyaan')
            ->where('class_id', $classId)
            ->findOrFail($id);

        $existing = QuizAttempt::where('user_id', auth()->id())
            ->where('kuis_id', $kuis->id)
            ->first();

        if ($existing) {
            return view('siswa.evaluasi.result', [
                'score' => $existing->score,
                'correct' => $existing->correct,
                'total' => $existing->total,
            ]);
        }

        $jawaban = json_decode($request->jawaban_data, true) ?? [];

        $correct = 0;
        $total = $kuis->pertanyaan->count();

        foreach ($kuis->pertanyaan as $q) {

            $userAnswer = $jawaban[$q->id] ?? null;
            $correctAnswer = $q->jawaban_benar;

            if ($q->tipe_soal == 'card_choice') {

                if ($userAnswer == $correctAnswer) {
                    $correct++;
                }
            } elseif ($q->tipe_soal == 'drag_drop') {

                if ($userAnswer == $correctAnswer) {
                    $correct++;
                }
            } elseif ($q->tipe_soal == 'susun_balok') {

                if (is_array($userAnswer) && $userAnswer == $correctAnswer) {
                    $correct++;
                }
            }
        }

        $score = $total ? round(($correct / $total) * 100) : 0;

        $attempt = QuizAttempt::create([
            'user_id' => auth()->id(),
            'kuis_id' => $kuis->id,
            'score' => $score,
            'correct' => $correct,
            'total' => $total,
            'submitted_at' => now(),
        ]);

        return view('siswa.evaluasi.result', [
            'score' => $attempt->score,
            'correct' => $attempt->correct,
            'total' => $attempt->total,
        ]);
    }
}
