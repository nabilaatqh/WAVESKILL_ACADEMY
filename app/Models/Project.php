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
        'tipe', // TAMBAHKAN INI
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
