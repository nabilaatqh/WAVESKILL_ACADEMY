<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Instruktur extends Authenticatable
{
    use Notifiable;

    protected $guard = 'instruktur';

    protected $fillable = [
        'name',
        'email',
        'password',
        'nama_awal',
        'nama_akhir',
        'domisili',
        'tentang_saya',
        'telepon',
        'tempat_lahir',
        'tanggal_lahir',
];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi: Instruktur punya banyak kelas
    public function course()
    {
        return $this->hasMany(Course::class, 'instruktur_id');
    }
}
