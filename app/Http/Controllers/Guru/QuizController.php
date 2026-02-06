<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::orderBy('id', 'asc')->get();
        return view('guru.quiz.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guru.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kelas' => 'required',
            'status' => 'required'
        ]);

        Quiz::create($request->all());

        return redirect()->route('guru.quiz.index')->with('success', 'Kuis berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         return view('guru.quiz.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $quizzes = Quiz::findOrFail($id);
        return view('guru.quiz.edit', compact('quizzes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $quizzes->update($request->all());
        return redirect()->route('guru.quiz.index')->with('success', 'Kuis diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)

    {
        Quiz::destroy($id);

       return redirect()->route('guru.quiz.index')
            ->with('success', 'Kuis berhasil dihapus');
    }
}
