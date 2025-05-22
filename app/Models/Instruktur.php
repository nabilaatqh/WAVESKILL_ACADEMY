<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Instruktur extends Authenticatable
{
    use Notifiable;

    // Nama guard untuk autentikasi
    protected $guard = 'instruktur';

    // Kolom yang boleh diisi massal
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone', // jika ada kolom phone di migrasi, bisa ditambahkan
    ];

    // Kolom yang harus disembunyikan saat serialisasi
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Cast kolom tertentu ke tipe data lain
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi ke kelas yang diajar
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'instruktur_id');
    }
}
