<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = [
        'judul', 'tipe', 'deskripsi', 'konten', 'gambar', 'video_url'
    ];
}
