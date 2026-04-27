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
        $kelas = auth()->user()->kelas;

        $moduls = \App\Models\modul::with(['comments.user', 'comments.replies.user'])
            ->where('class_id', $kelas->id)
            ->latest()
            ->get();

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

        if ($modul->class_id != auth()->user()->class_id) {
            abort(403, 'Akses ditolak');
        }

        return Storage::disk('public')->download($modul->file_materi);
    }
}
