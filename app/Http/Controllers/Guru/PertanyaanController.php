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
            'gambar_soal' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'opsi_a' => 'required',
            'gambar_opsi_a' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'opsi_b' => 'required',
            'gambar_opsi_b' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'opsi_c' => 'required',
            'gambar_opsi_c' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'opsi_d' => 'required',
            'gambar_opsi_d' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'opsi_e' => 'nullable',
            'gambar_opsi_e' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'jawaban_benar' => 'required|in:a,b,c,d,e',
        ]);

        $data['kuis_id'] = $kuis_id;

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
        $data = $request->validate([
            'soal' => 'required',
            'gambar_soal' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'opsi_a' => 'required',
            'gambar_opsi_a' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'opsi_b' => 'required',
            'gambar_opsi_b' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'opsi_c' => 'required',
            'gambar_opsi_c' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'opsi_d' => 'required',
            'gambar_opsi_d' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'opsi_e' => 'nullable',
            'gambar_opsi_e' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'jawaban_benar' => 'required|in:a,b,c,d,e',
        ]);

        $pertanyaan = Pertanyaan::findOrFail($id);

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

        $pertanyaan->update($data);

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
