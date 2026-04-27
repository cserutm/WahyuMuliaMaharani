<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Classes;
use App\Models\Semester;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'class_id',
        'semester_id'
    ];

    public function isSiswa()
    {
        return $this->role === 'siswa';
    }
    public function isGuru()
    {
        return $this->role === 'guru';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id')->latest();
    }
}
