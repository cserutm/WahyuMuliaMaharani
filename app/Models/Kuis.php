<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'kelas',
        'status',
    ];

    public function pertanyaan()
{
    return $this->hasMany(Pertanyaan::class, 'kuis_id');
}
public function quizAttempts()
{
    return $this->hasMany(\App\Models\QuizAttempt::class);
}
}
