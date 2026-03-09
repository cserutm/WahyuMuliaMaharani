<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;

class SemesterController extends Controller
{
   public function index()
    {
        $semesters = Semester::latest()->get();
        return view('guru.semester.index', compact('semesters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_semester' => 'required',
            'tahun_ajaran' => 'required'
        ]);

        Semester::create([
            'nama_semester' => $request->nama_semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'created_by' => auth()->id()
        ]);

        return back()->with('success','Semester berhasil ditambahkan');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_semester' => 'required',
            'tahun_ajaran' => 'required'
        ]);

        $semester = Semester::findOrFail($id);

        $semester->update([
            'nama_semester' => $request->nama_semester,
            'tahun_ajaran' => $request->tahun_ajaran
        ]);

        return back()->with('success','Semester berhasil diperbarui');
    }

    // DELETE
    public function destroy($id)
    {
        $semester = Semester::findOrFail($id);
        $semester->delete();

        return back()->with('success','Semester berhasil dihapus');
    }
}

