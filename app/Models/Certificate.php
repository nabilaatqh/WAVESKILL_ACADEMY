<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table = 'certificates';

    protected $fillable = [
        'course_id',
        'student_id',
        'certificate_code',
        'issued_at',
        'valid_until',
        'file_path', // misal file PDF sertifikat
    ];

    // Relasi ke course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relasi ke student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
