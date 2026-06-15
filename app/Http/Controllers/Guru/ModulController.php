<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\modul;
use App\Models\Classes;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModulController extends Controller
{

    public function index(Request $request)
    {
        // Ambil semester aktif
        $semesterAktif = Semester::where('is_active', true)->first();

        if (!$semesterAktif) {
            return redirect()->back()->with('error', 'Semester aktif belum diatur');
        }

        // Ambil kelas berdasarkan semester aktif
        $classes = Classes::where('semester_id', $semesterAktif->id)->get();

        // Ambil modul hanya dari kelas semester aktif
        $modul = modul::with('kelas')

            ->whereHas('kelas', function ($query) use ($semesterAktif) {
                $query->where('semester_id', $semesterAktif->id);
            })

            ->when($request->class_id, function ($query) use ($request) {
                $query->where('class_id', $request->class_id);
            })

            ->latest()
            ->paginate(10);

        return view('guru.modul.index', compact(
            'modul',
            'classes',
            'semesterAktif'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tujuan_pembelajaran' => 'required|string',
            'ringkasan' => 'nullable|string',
            'poin_penting' => 'nullable|string',
            'fakta_menarik' => 'nullable|string',

            'gambar_materi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'file_materi' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'video_url' => 'nullable|url'

        ]);

        $path = $request->file('file_materi')->store('modul_materi', 'public');
        $gambar = null;

        if ($request->hasFile('gambar_materi')) {
            $gambar = $request->file('gambar_materi')
                ->store('gambar_materi', 'public');
        }
        modul::create([
            'class_id' => $request->class_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tujuan_pembelajaran' => $request->tujuan_pembelajaran,


            'ringkasan' => $request->ringkasan,
            'poin_penting' => $request->poin_penting,
            'fakta_menarik' => $request->fakta_menarik,

            'gambar_materi' => $gambar,

            'file_materi' => $path,
            'video_url' => $request->video_url
        ]);

        return redirect()->route('guru.modul.index')
            ->with('success', 'Materi berhasil ditambahkan.');
    }


    public function show($id)
    {
        $modul = modul::with('kelas')->findOrFail($id);
        return view('guru.modul.show', compact('modul'));
    }


    public function update(Request $request, $id)
    {
        $modul = modul::findOrFail($id);

        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tujuan_pembelajaran' => 'required|string',
            'ringkasan' => 'nullable|string',
            'poin_penting' => 'nullable|string',
            'fakta_menarik' => 'nullable|string',
            'gambar_materi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'file_materi' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'video_url' => 'nullable|url'
        ]);

        $data = [
            'class_id' => $request->class_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tujuan_pembelajaran' => $request->tujuan_pembelajaran,
            'ringkasan' => $request->ringkasan,
            'poin_penting' => $request->poin_penting,
            'fakta_menarik' => $request->fakta_menarik,
            'video_url' => $request->video_url
        ];

        if ($request->hasFile('gambar_materi')) {

            if (
                $modul->gambar_materi &&
                Storage::disk('public')->exists($modul->gambar_materi)
            ) {
                Storage::disk('public')->delete($modul->gambar_materi);
            }

            $data['gambar_materi'] =
                $request->file('gambar_materi')
                ->store('gambar_materi', 'public');
        }

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
