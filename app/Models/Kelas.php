<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instruktur;
use App\Models\Materi;
use App\Models\Project;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'deskripsi',
        'banner',
        'instruktur_id',
    ];

    public function instruktur()
    {
        return $this->belongsTo(Instruktur::class);
    }

    public function materis()
    {
        return $this->hasMany(Materi::class, 'kelas_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
