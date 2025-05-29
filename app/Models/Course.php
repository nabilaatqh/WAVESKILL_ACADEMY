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

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'nama_course',
        'instruktur_id',
        'deskripsi',
        'harga',
        'whatsapp_link',
        'banner_image',
    ];

    /**
     * Instruktur pemilik course
     */
    public function instruktur()
    {
        return $this->belongsTo(User::class, 'instruktur_id')
                    ->where('role', 'instructor');
    }

    /**
     * Mahasiswa yang terdaftar (many-to-many)
     */
    public function students()
    {
        return $this->belongsToMany(
            User::class,
            'course_student',
            'course_id',
            'student_id'
        )->where('role', 'student');
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

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

}   
