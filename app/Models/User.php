<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',

        // Tambahan profil
        'nama_awal',
        'nama_akhir',
        'domisili',
        'tentang_saya',
        'telepon',
        'tempat_lahir',
        'tanggal_lahir',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'tanggal_lahir' => 'date',
        'is_active' => 'boolean',
    ];

    // ======================== ROLE HELPER ========================
    public function isInstruktur()
    {
        return $this->role === 'instruktur';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // ======================== RELASI UNTUK INSTRUKTUR ========================
    public function courses()
    {
        return $this->hasMany(Course::class, 'instruktur_id');
    }

    // Alias jika butuh course() di mana-mana
    public function course()
    {
        return $this->courses();
    }

    // ======================== RELASI UNTUK STUDENT ========================

    // Course yang diikuti oleh student
    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'student_id', 'course_id');
    }

    // Alias enrollments
    public function enrollments()
    {
        return $this->enrolledCourses();
    }

    // Relasi ke submissions (project submissions student)
    public function submissions()
    {
        return $this->hasMany(Submission::class, 'student_id');
    }

    // Relasi ke sertifikat yang dimiliki student
    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'student_id');
    }

    // Grup (jika digunakan)
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_student', 'student_id', 'group_id');
    }
}