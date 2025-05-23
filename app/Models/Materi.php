<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'file_path',
        'course_id',
    ];

    // Relasi ke kelas
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
