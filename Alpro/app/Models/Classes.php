<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
   protected $table = 'classes';

    protected $fillable = [
        'nama_kelas',
        'semester_id',
        'created_by'
    ];
public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function kuis()
    {
        return $this->hasMany(Kuis::class);
    }

    public function modul()
{
    return $this->hasMany(Modul::class,'class_id');
}
}
