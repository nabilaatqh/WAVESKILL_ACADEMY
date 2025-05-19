<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama',
        'deskripsi',
        'banner',
        'instruktur_id',
    ];

    // Relasi ke instruktur (user yang mengajar kelas ini)
    public function instruktur()
    {
        return $this->belongsTo(User::class, 'instruktur_id');
    }

    // Relasi ke materi-materi dalam kelas
    public function materi()
    {
        return $this->hasMany(Materi::class);
    }

    // Relasi ke project-project dalam kelas
    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
