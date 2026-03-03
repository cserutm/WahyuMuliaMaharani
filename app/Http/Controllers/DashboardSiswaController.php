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
        $totalMateri = modul::count() + video::count();
        $totalKuis   = Kuis::count();

        return view('dashboard-siswa', compact('totalMateri', 'totalKuis'));
    }
}