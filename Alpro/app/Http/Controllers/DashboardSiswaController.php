<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\modul;
use App\Models\video;
use App\Models\Kuis;

class DashboardSiswaController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // ambil class & semester dari user
        $classId = $user->class_id;
        $semesterId = $user->semester_id;

        

        // ❗ safety (kalau belum ada data)
        if (!$classId || !$semesterId) {
            return redirect()->route('login')->withErrors('Data kelas/semester belum tersedia');
        }



        // hitung kuis sesuai kelas
        $totalKuis = Kuis::where('status', 'aktif')
            ->where('class_id', $classId)
            ->count();

         
       $totalMateri = modul::all()
    ->where('class_id', $classId)
    ->count();

    return view('dashboard-siswa', compact('totalKuis', 'totalMateri'));

   
}
}
