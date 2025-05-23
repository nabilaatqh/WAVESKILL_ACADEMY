<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instruktur;
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

    public function instruktur()
    {
        return $this->belongsTo(Instruktur::class, 'instruktur_id');
    }

    public function materis()
    {
        return $this->hasMany(Materi::class, 'course_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
