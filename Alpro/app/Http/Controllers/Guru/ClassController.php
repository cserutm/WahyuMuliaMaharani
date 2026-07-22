<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Semester;

class ClassController extends Controller
{
    public function index()
    {
        // ambil semester aktif
        $semesterAktif = Semester::where('is_active', 1)->first();

        // jika belum ada semester aktif
        if (!$semesterAktif) {
            return view('guru.classes.index', [
                'classes' => collect(),
                'semesters' => Semester::all(),
                'semesterAktif' => null
            ])->with('error', 'Belum ada semester yang aktif.');
        }

        // ambil kelas sesuai semester aktif
        $classes = Classes::with('semester')
            ->where('semester_id', $semesterAktif->id)
            ->get();

        $semesters = Semester::all();

        return view('guru.classes.index', compact('classes', 'semesters', 'semesterAktif'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required'
        ]);

        // ambil semester aktif
        $semesterAktif = Semester::where('is_active', 1)->first();

        if (!$semesterAktif) {
            return back()->with('error', 'Tidak bisa menambah kelas karena belum ada semester aktif.');
        }

        Classes::create([
            'nama_kelas' => $request->nama_kelas,
            'semester_id' => $semesterAktif->id,
            'created_by' => auth()->id()
        ]);

        return back()->with('success', 'Kelas berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required'
        ]);

        $class = Classes::findOrFail($id);

        $class->update([
            'nama_kelas' => $request->nama_kelas
        ]);

        return back()->with('success', 'Kelas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $class = Classes::findOrFail($id);

        $class->delete();

        return back()->with('success', 'Kelas berhasil dihapus');
    }
}