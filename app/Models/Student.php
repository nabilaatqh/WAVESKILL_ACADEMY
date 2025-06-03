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

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }

    public function enrolledcourse()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'student_id', 'course_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_student', 'student_id', 'group_id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'student_id');
    }
    
    public function course()
    {
        return $this->belongsToMany(Course::class, 'course_student', 'student_id', 'course_id');
    }

}