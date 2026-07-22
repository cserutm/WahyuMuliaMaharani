<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use App\Models\Classes;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $kuis = Kuis::orderBy('id', 'asc')->get();
    $classes = Classes::all();

    return view('guru.kuis.index', compact('kuis','classes'));
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
    public function store(Request $request)
    {
        $request->validate([
    'judul' => 'required|string|max:255',
    'class_id' => 'required|exists:classes,id',
    'status' => 'required|in:aktif,draft,nonaktif',
]);
    

       Kuis::create([
    'judul' => $request->judul,
    'class_id' => $request->class_id,
    'status' => $request->status
]);

        return redirect()->route('guru.kuis.index')->with('success', 'Kuis berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         return view('guru.kuis.show', compact('kuis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         $kuis = Kuis::findOrFail($id);
        return view('guru.kuis.edit', compact('kuis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)

    {
        $kuis = Kuis::findOrFail($id);
    $kuis->update([
    'judul' => $request->judul,
    'class_id' => $request->class_id,
    'status' => $request->status
]);
        return redirect()->route('guru.kuis.index')->with('success', 'Kuis diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         Kuis::destroy($id);

       return redirect()->route('guru.kuis.index')
            ->with('success', 'Kuis berhasil dihapus');
    }
}
