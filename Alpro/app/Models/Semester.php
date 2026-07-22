<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
      protected $fillable = [
        'nama_semester',
         'tahun_ajaran',
        'created_by',
        'is_active'

    ];

    public function classes()
    {
        return $this->hasMany(Classes::class);
    }
    public function creator()
{
    return $this->belongsTo(User::class, 'created_by');
}
}
