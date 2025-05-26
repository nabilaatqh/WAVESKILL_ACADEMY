<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Certificate;

class Course extends Model
{
    use HasFactory;

    // Tambahkan kolom yang bisa diisi
    protected $fillable = ['nama_course', 'instruktur_id', 'deskripsi', 'harga', 'whatsapp_link', 'banner_image'];

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

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
