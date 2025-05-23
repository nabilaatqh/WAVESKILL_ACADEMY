<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Materi;
use App\Models\Project;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'nama_course',
        'deskripsi',
        'banner',
        'instruktur_id',
    ];

    // Relasi: Course dimiliki oleh 1 Instruktur (User dengan role 'instruktur')
    public function instruktur()
    {
        return $this->belongsTo(User::class, 'instruktur_id')->where('role', 'instruktur');
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
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'student_id')
                    ->where('role', 'student');
    }
}
