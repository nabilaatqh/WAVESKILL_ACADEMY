<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'nama_kelas',
        'instruktur_id',
        'whatsapp_link',
        'banner',
    ];

    public function instruktur()
    {
        return $this->belongsTo(Instruktur::class, 'instruktur_id');
    }

    public function materis()
    {
        return $this->hasMany(Materi::class, 'kelas_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'kelas_id');
    }

    public function group()
    {
        return $this->hasOne(Group::class, 'kelas_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'kelas_student', 'kelas_id', 'student_id');
    }
}
