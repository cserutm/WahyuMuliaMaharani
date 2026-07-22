<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\modul;

class MateriGuruController extends Controller
{
    public function index()
{
    $modul = modul::latest()->get();
    return view('guru.materi', compact('modul'));
}
}


