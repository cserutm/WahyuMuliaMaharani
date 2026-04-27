<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modul extends Model
{
    use HasFactory;

    protected $table = 'modul';

    protected $fillable = [
        'class_id',
        'judul',
        'deskripsi',
        'tujuan_pembelajaran',
        'file_materi',
        'video_url',
    ];

    public function kelas()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
