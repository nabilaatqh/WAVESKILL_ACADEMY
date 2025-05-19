<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materis';

    protected $fillable = [
        'kelas_id',
        'judul',
        'deskripsi',
        'file',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
