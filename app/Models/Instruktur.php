<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instruktur extends Authenticatable
{
    use HasFactory;

    protected $table = 'users'; // Pakai tabel users

    public function courses()
    {
        return $this->hasMany(Course::class, 'instruktur_id');
    }
}
