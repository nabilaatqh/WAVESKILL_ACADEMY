<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instruktur extends Authenticatable
{
    use Notifiable, HasFactory;

    // Kalau use table users (default Laravel)
//  protected $table = 'users'; 

    // Jika butuh guard khusus, pastikan juga di config/auth.php ada guard instruktur
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
        'foto',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi: satu instruktur punya banyak course
    public function courses()
    {
        return $this->hasMany(Course::class, 'instruktur_id');
    }
}
    