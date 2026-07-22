<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\modul;
use App\Models\Notification;
use App\Models\User;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'isi' => 'required'
        ]);

        $comment = Comment::create([

            'modul_id' => $request->modul_id,
            'user_id' => auth()->id(),
            'parent_id' => $request->parent_id, // null atau isi
            'isi' => $request->isi
        ]);
        $user = auth()->user();
        if ($user->role == 'siswa') {

            $gurus = User::where('role', 'guru')->get();

            foreach ($gurus as $guru) {
                Notification::create([
                    'user_id' => $guru->id,
                    'judul' => 'Komentar Baru',
                    'pesan' => $user->name . ' mengomentari materi',
                ]);
            }
        }
        if ($request->parent_id) {

            $parent = Comment::find($request->parent_id);

            if ($parent && $parent->user_id != $user->id) {
                Notification::create([
                    'user_id' => $parent->user_id,
                    'judul' => 'Balasan Komentar',
                    'pesan' => $user->name . ' membalas komentar kamu',
                ]);
            }
        }

        return back();
    }
}
