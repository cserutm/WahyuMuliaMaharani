<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;

class PilihKelasController extends Controller
{
    public function index()
    {
        $semesters = Semester::with('classes')->get();
        $user = auth()->user();

        return view('siswa.pilih-kelas', compact('semesters','user'));
    }

    public function simpan(Request $request)
    {
        session([
            'semester_id' => $request->semester_id,
            'class_id' => $request->class_id
        ]);

        return redirect()->route('dashboard-siswa');
    }
}