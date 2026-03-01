<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\modul;
use App\Models\video;
use App\Models\Materi;

class SiswaMateriController extends Controller
{
     // Menu utama materi
    public function index()
    {
        return view('siswa.materi.index');
    }

    // List modul/file
   
    public function modul()
{
    $moduls = \App\Models\modul::latest()->get();
    return view('siswa.materi.modul', compact('moduls'));
}

    // List video
    public function video()
    {
        $videos = \App\Models\video::latest()->get();
        return view('siswa.materi.video', compact('videos'));
}

public function download($id)
{
    $modul = modul::findOrFail($id);

    $path = $modul->file_materi;

    return Storage::disk('public')->download($path);
}
}