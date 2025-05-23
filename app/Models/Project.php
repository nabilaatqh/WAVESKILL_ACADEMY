<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'course_id',
    ];

    // Relasi ke kelas
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relasi ke submission (jika ada model Submission)
    // public function submissions()
    // {
    //     return $this->hasMany(Submission::class);
    // }
}
