<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'modul_id',
        'user_id',
        'parent_id',
        'isi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modul()
    {
        return $this->belongsTo(Modul::class);
    }

    // 🔁 relasi reply
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
