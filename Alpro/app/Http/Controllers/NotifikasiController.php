<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotifikasiController extends Controller
{
    public function read($id)
    {
        $notif = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if ($notif) {
            $notif->is_read = true;
            $notif->save();

            return redirect($notif->url ?? url()->previous());
        }

        return back();
    }

    public function readAll()
    {
        Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return back();
    }
}
