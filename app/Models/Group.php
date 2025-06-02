<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    // Jika tabel bukan plural dari nama model, sesuaikan nama tabel
    protected $table = 'groups'; // misal nama tabel groups

    protected $fillable = [
        'course_id',
        'link_whatsapp',
        'deskripsi',
        'title',
        'nama_course'        // nama grup/kategori grup
    ];

    // Relasi ke Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'group_student', 'group_id', 'student_id');
    }
}
