<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\video;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
     $videos = video::paginate(10);
    return view('guru.video.index', compact('videos'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,)
    {
         $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tujuan_pembelajaran' => 'required|string',
            'video_url' => 'required|url',
        ]);

        video::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tujuan_pembelajaran' => $request->tujuan_pembelajaran,
            'video_url' => $request-> video_url,
        ]);

        return redirect()->route('guru.video.index')->with('success', 'Materi berhasil ditambahkan.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         $videos = video::findOrFail($id);
        return view('guru.video.show', compact('videos'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
          $videos = video::findOrFail($id);
        return view('guru.video.edit', compact('videos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $videos = video::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tujuan_pembelajaran' => 'required|string',
            'video_url' => 'nullable|url',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tujuan_pembelajaran' => $request->tujuan_pembelajaran,
        ];

        $videos->update($data);

        return redirect()->route('guru.video.index')->with('success', 'Materi berhasil diperbarui.');
    }

  
    public function destroy($id)
    {
         $videos = video::findOrFail($id);

        $videos->delete();

        return redirect()->route('guru.video.index')->with('success', 'Materi berhasil dihapus.');
    
    }
}
