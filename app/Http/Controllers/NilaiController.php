<?php

namespace App\Http\Controllers;

use App\Exports\NilaiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\QuizAttempt;


class NilaiController extends Controller
{
    public function nilai()
    {

        $attempts = QuizAttempt::with(['user.kelas', 'kuis'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('guru.nilai', compact('attempts'));
    }
    public function export(Request $request)
    {
        $kelasId = $request->kelas_id;

        return Excel::download(new NilaiExport($kelasId), 'data_nilai.xlsx');
    }
}
