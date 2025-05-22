<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'link_whatsapp',
        'deskripsi',
    ];

    // Relasi ke kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
