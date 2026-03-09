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
        $classes = Classes::with('semester')->get();
        $semesters = Semester::all();

        return view('guru.classes.index', compact('classes','semesters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'semester_id' => 'required'
        ]);

        Classes::create([
            'nama_kelas' => $request->nama_kelas,
            'semester_id' => $request->semester_id,
            'created_by' => auth()->id()
        ]);

        return back()->with('success','Kelas berhasil ditambahkan');
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'nama_kelas' => 'required',
        'semester_id' => 'required'
    ]);

    $class = Classes::findOrFail($id);

    $class->update([
        'nama_kelas' => $request->nama_kelas,
        'semester_id' => $request->semester_id
    ]);

    return back()->with('success','Kelas berhasil diperbarui');
}

public function destroy($id)
{
    $class = Classes::findOrFail($id);

    $class->delete();

    return back()->with('success','Kelas berhasil dihapus');
}
}
