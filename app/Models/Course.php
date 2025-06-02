<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Group;
use App\Models\Certificate;
use App\Models\Enrollment;
use App\Models\Project;
use App\Models\Materi;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'nama_course',
        'instruktur_id',
        'deskripsi',
        'harga',
        'whatsapp_link',
        'banner_image',
        'certificate_file',
    ];

    public function instruktur()
    {
        return $this->belongsTo(User::class, 'instruktur_id');
    }

    public function materis()
    {
        return $this->hasMany(Materi::class, 'course_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'course_id');
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
{
    return $this->belongsToMany(Student::class, 'enrollments', 'course_id', 'student_id');
}


    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
