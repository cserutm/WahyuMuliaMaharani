<?php

namespace App\Models;
use App\Models\Classes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'class_id',
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
public function class()
{
    return $this->belongsTo(Classes::class, 'class_id');
}
}
