<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Course;
use App\Models\Group;
use App\Models\Certificate;
use App\Models\Enrollment;

class Student extends Authenticatable
{
    use Notifiable;

    protected $guard = 'student';
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'username', 'password', 'photo', 'phone',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi enrollments
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }

    // ✅ Course yang sudah disetujui admin
    public function approvedCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'student_id', 'course_id')
                    ->withPivot('status')
                    ->wherePivot('status', 'approved');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_student', 'student_id', 'group_id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'student_id');
    }

    public function submissions()
    {
        return $this->hasMany(\App\Models\Submission::class, 'student_id');
    }
}
