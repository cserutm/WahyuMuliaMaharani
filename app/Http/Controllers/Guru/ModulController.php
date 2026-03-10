<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModulController extends Controller
{
    public function index()
    {
        $modul = modul::paginate(10);
        return view('guru.modul.index', compact('modul'));
    }

    public function create()
    {
        return view('guru.modul.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tujuan_pembelajaran' => 'required|string',
            'file_materi' => 'required|file|mimes:pdf|max:10240',
            'video_url' => 'nullable|url'
        ]);

        $path = $request->file('file_materi')->store('modul_materi', 'public');

        modul::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tujuan_pembelajaran' => $request->tujuan_pembelajaran,
            'file_materi' => $path,
            'video_url' => $request->video_url
        ]);

        return redirect()->route('guru.modul.index')
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $modul = modul::findOrFail($id);
        return view('guru.modul.show', compact('modul'));
    }

    public function edit($id)
    {
        $modul = modul::findOrFail($id);
        return view('guru.modul.edit', compact('modul'));
    }

    public function update(Request $request, $id)
    {
        $modul = modul::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tujuan_pembelajaran' => 'required|string',
            'file_materi' => 'nullable|file|mimes:pdf|max:10240',
            'video_url' => 'nullable|url'
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tujuan_pembelajaran' => $request->tujuan_pembelajaran,
            'video_url' => $request->video_url
        ];

        if ($request->hasFile('file_materi')) {

            if ($modul->file_materi && Storage::disk('public')->exists($modul->file_materi)) {
                Storage::disk('public')->delete($modul->file_materi);
            }

            $path = $request->file('file_materi')->store('modul_materi', 'public');
            $data['file_materi'] = $path;
        }

        $modul->update($data);

        return redirect()->route('guru.modul.index')
            ->with('success', 'Materi berhasil diperbarui.');
    }

    public function download($id)
    {
        $modul = modul::findOrFail($id);
        return Storage::disk('public')->download($modul->file_materi);
    }

    public function destroy($id)
    {
        $modul = modul::findOrFail($id);

        if ($modul->file_materi && Storage::disk('public')->exists($modul->file_materi)) {
            Storage::disk('public')->delete($modul->file_materi);
        }

        $modul->delete();

        return redirect()->route('guru.modul.index')
            ->with('success', 'Materi berhasil dihapus.');
    }
}