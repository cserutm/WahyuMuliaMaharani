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
        $data = $request->validate([
            'soal' => 'required',
            'tipe_soal' => 'required|in:drag_drop,susun_balok,card_choice',
            'kategori_hots' => 'required|in:HOTS,LOTS',

            'jawaban_benar' => 'required|json',

            'gambar_soal' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'opsi_e' => 'nullable',
        ]);

        $data['kuis_id'] = $kuis_id;
        $data['jawaban_benar'] = json_decode($request->jawaban_benar, true);

        foreach (
            [
                'gambar_soal',
                'gambar_opsi_a',
                'gambar_opsi_b',
                'gambar_opsi_c',
                'gambar_opsi_d',
                'gambar_opsi_e'
            ] as $field
        ) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('kuis/pertanyaan', 'public');
            }
        }

        Pertanyaan::create($data);

        return back()->with('success', 'Soal berhasil ditambahkan');
    }

    // ================= EDIT =================
    public function edit($kuis_id, $id)
    {
        $kuis = Kuis::findOrFail($kuis_id);

        $pertanyaan = Pertanyaan::findOrFail($id);

        return view(
            'guru.kuis.pertanyaan.edit',
            compact('kuis', 'pertanyaan')
        );
    }

    public function update(Request $request, $kuis_id, $id)
    {
        $data = $request->validate([
            'soal' => 'required',
            'tipe_soal' => 'required|in:drag_drop,susun_balok,card_choice',
            'kategori_hots' => 'required|in:HOTS,LOTS',
            'jawaban_benar' => 'required|json',

            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'opsi_e' => 'nullable',
        ]);

        $pertanyaan = Pertanyaan::findOrFail($id);

        $data['jawaban_benar'] = json_decode($request->jawaban_benar, true);

        $pertanyaan->update($data);

        return back()->with('success', 'Soal berhasil diupdate');
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
