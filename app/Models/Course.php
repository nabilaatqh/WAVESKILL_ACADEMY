<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Tambahkan kolom yang bisa diisi
    protected $fillable = ['nama_course', 'instruktur_id', 'deskripsi', 'whatsapp_link', 'banner_image', 'harga'];

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
        return $this->hasMany(\App\Models\Group::class);
    }

    // app/Models/Course.php

    public function materis()
    {
        return $this->hasManyThrough(
            \App\Models\Materi::class,  // Model tujuan akhir
            \App\Models\Kelas::class,   // Model perantara
            'course_id',                // FK di kelas: mengacu ke course
            'kelas_id',                 // FK di materi: mengacu ke kelas
            'id',                       // PK di course
            'id'                        // PK di kelas
        );
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function kelass()
    {
        return $this->hasMany(Kelas::class);
    }


}
