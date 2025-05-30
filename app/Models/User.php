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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'tanggal_lahir' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Helper method untuk cek role instruktur
     */
    public function isInstruktur()
    {
        return $this->role === 'instruktur';
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'instruktur_id');
    }

    // Relasi dengan courses (student)
    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'course_student', 'student_id', 'course_id');
    }
}
