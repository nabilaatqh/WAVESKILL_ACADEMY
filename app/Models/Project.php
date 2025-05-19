<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'judul',
        'deskripsi',
        'deadline',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
