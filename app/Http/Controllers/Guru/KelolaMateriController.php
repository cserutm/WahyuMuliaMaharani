<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;

class KelolaMateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $materis = Materi::orderBy('id', 'asc')->get();
        return view('guru.materi.index', compact('materis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guru.materi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tipe' => 'required',
            'deskripi' => 'required',
            'konten' => 'required',
            'gambar' => 'required',
            'video_url' => 'required'


        ]);

        Materi::create($request->all());

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         $materis = Materi::findOrFail($id);
        return view('guru.materi.edit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $materis->update($request->all());
        return redirect()->route('guru.materi.index')->with('success', 'Materi diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         Materi::destroy($id);

       return redirect()->route('guru.materi.index')
            ->with('success', 'Materi berhasil dihapus');
    }
}
