<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Group;
use App\Models\Certificate;
use App\Models\Enrollment;
use App\Models\Project;
use App\Models\Kelas;
use App\Models\Materi;

class Course extends Model
{
    use HasFactory;
    protected $table = 'courses'; 
    // Kolom yang bisa diisi massal
    protected $fillable = [
        'nama_course',
        'instruktur_id',
        'deskripsi',
        'harga',
        'whatsapp_link',
        'banner_image',
    ];

    // Relasi ke instruktur (User dengan role 'instructor')
    public function instruktur()
    {
        return $this->belongsTo(User::class, 'instruktur_id')
                    ->where('role', 'instruktur');
    }

    // Relasi: Course memiliki banyak Materi
    public function materis()
    {
        return $this->hasMany(Materi::class, 'course_id');
    }

    // Relasi: Course memiliki banyak Project
    public function projects()
    {
        return $this->hasMany(Project::class, 'course_id');
    }

    // Relasi: Course diikuti oleh banyak Student (User dengan role 'student')
    public function students()
    {
        return $this->belongsToMany(
            User::class,
            'course_student',
            'course_id',
            'student_id'
        )
                    ->where('role', 'student');
    }

    /**
     * Grup WhatsApp / Telegram untuk course ini
     */
    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function kelass()
    {
        return $this->hasMany(Kelas::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

}   
