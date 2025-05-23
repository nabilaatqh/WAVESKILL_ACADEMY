<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Tambahkan kolom yang bisa diisi
    protected $fillable = ['nama_course', 'instruktur_id', 'deskripsi', 'banner_image'];

    // Relasi ke instruktur (User dengan role 'instructor')
    public function instruktur()
    {
        return $this->belongsTo(User::class, 'instruktur_id')->where('role', 'instructor');
    }

    // Relasi many to many ke student (User dengan role 'student')
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'student_id')->where('role', 'student');
    }
}
