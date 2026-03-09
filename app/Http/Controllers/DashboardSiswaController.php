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
    if(!session('class_id')){
        return redirect()->route('siswa.pilih-kelas');
    }

    $classId = session('class_id');

    $totalKuis = Kuis::where('status','aktif')
        ->where('class_id',$classId)
        ->count();

    return view('dashboard-siswa', compact('totalKuis'));
}
}