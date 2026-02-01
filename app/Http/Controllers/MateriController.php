<?php
namespace App\Http\Controllers;

use App\Models\Materi;

class MateriController extends Controller
{
    public function index()
    {
        $materi = Materi::latest()->get();
        return view('siswa.materi', compact('materi'));
    }


    public function materiTeks()
{
    $materi = \App\Models\Materi::where('tipe', 'teks')->first();
    return view('siswa.materi_teks', compact('materi'));
}

public function materiVideo()
{
    $materi = \App\Models\Materi::where('tipe', 'video')->first();
    return view('siswa.materi_video', compact('materi'));
}

}
