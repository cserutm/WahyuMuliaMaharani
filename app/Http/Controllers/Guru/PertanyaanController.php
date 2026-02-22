<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kuis;
use App\Models\Pertanyaan;

class PertanyaanController extends Controller
{
    // ================= INDEX =================
    public function index($kuis_id)
    {
        $kuis = Kuis::with('pertanyaan')->findOrFail($kuis_id);
        return view('guru.kuis.pertanyaan.index', compact('kuis'));
    }

    // ================= STORE =================
    public function store(Request $request, $kuis_id)
    {
        $request->validate([
            'soal' => 'required',
            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'opsi_e' => 'required',
            'jawaban_benar' => 'required|in:a,b,c,d,e',
        ]);

        Pertanyaan::create([
            'kuis_id' => $kuis_id,
            'soal' => $request->soal,
            'opsi_a' => $request->opsi_a,
            'opsi_b' => $request->opsi_b,
            'opsi_c' => $request->opsi_c,
            'opsi_d' => $request->opsi_d,
            'opsi_e' => $request->opsi_e,
            'jawaban_benar' => $request->jawaban_benar,
        ]);

        return redirect()
            ->route('guru.kuis.pertanyaan.index', $kuis_id)
            ->with('success', 'Soal berhasil ditambahkan');
    }

    // ================= EDIT =================
    public function edit($kuis_id, $id)
    {
        $kuis = Kuis::findOrFail($kuis_id);
        $pertanyaan = Pertanyaan::findOrFail($id);

        return view('guru.kuis.pertanyaan.edit', compact('kuis', 'pertanyaan'));
    }

    // ================= UPDATE =================
    public function update(Request $request, $kuis_id, $id)
    {
        $request->validate([
            'soal' => 'required',
            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'opsi_e' => 'required',
            'jawaban_benar' => 'required|in:a,b,c,d,e',
        ]);

        $pertanyaan = Pertanyaan::findOrFail($id);

        $pertanyaan->update([
            'soal' => $request->soal,
            'opsi_a' => $request->opsi_a,
            'opsi_b' => $request->opsi_b,
            'opsi_c' => $request->opsi_c,
            'opsi_d' => $request->opsi_d,
            'opsi_e' => $request->opsi_e,
            'jawaban_benar' => $request->jawaban_benar,
        ]);

        return redirect()
            ->route('guru.kuis.pertanyaan.index', $kuis_id)
            ->with('success', 'Soal berhasil diupdate');
    }

    // ================= DELETE =================
    public function destroy($kuis_id, $id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);
        $pertanyaan->delete();

        return redirect()
            ->route('guru.kuis.pertanyaan.index', $kuis_id)
            ->with('success', 'Soal berhasil dihapus');
    }
}