<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class QuizAttempt extends Model
{
    protected $table = 'quizattempts';
    protected $fillable = [
        'user_id',
        'kuis_id',
        'score',
        'submitted_at'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Kuis()
    {
        return $this->belongsTo(Kuis::class);
    }
}
