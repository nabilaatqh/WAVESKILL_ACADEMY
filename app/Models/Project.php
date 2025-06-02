<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'course_id',
        'file',
        'tipe', 
    ];

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'project_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
