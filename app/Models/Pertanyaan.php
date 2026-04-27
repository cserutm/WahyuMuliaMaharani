<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;
    protected $table = 'pertanyaan';
    protected $fillable = [
        'kuis_id',
        'soal',
        'gambar_soal',

        'opsi_a',
        'gambar_opsi_a',
        'opsi_b',
        'gambar_opsi_b',
        'opsi_c',
        'gambar_opsi_c',
        'opsi_d',
        'gambar_opsi_d',
        'opsi_e',
        'gambar_opsi_e',

        'jawaban_benar'
    ];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'kuis_id');
    }
}
