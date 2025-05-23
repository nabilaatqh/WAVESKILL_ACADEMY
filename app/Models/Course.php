<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title', 'description', 'image', 'price',
    ];
    public function students()
    {
        // Pivot table enrollments, foreign keys: course_id dan student_id
        return $this->belongsToMany(Student::class, 'enrollments', 'course_id', 'student_id');
    }
    public function certificates()
    {
        return $this->hasMany(Certificate::class); // sesuaikan model Certificate dan foreign key di tabel certificates
    }
}
