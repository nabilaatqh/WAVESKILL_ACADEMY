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

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'project_id');
    }

    // Relasi ke kelas
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
