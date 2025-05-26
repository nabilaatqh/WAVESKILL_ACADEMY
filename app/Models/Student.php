<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Course;
use App\Models\Group;
use App\Models\Certificate;

class Student extends Authenticatable
{
    use Notifiable;

    protected $guard = 'student'; // Sesuai guard

    protected $table = 'users'; // Pakai tabel users

    protected $fillable = [
        'name', 'email', 'username', 'password', 'photo', 'phone',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi many-to-many ke courses via enrollments
    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'student_id', 'course_id');
    }

    // Relasi many-to-many ke groups via group_student
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_student', 'student_id', 'group_id');
    }

    // Relasi one-to-many ke certificates
    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'student_id');
    }

    protected $table = 'users';
    
    public function course()
    {
        return $this->belongsToMany(Course::class, 'course_student');
    }
}
