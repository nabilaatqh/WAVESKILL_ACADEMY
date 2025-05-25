<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    // Jika tabel bukan plural dari nama model, sesuaikan nama tabel
    protected $table = 'groups'; // misal nama tabel groups

    protected $fillable = [
        'course_id',       // foreign key ke tabel courses
        'title',           // nama grup/kategori grup
        'description',     // deskripsi grup (opsional)
        'whatsapp_link',   // link grup WhatsApp
    ];

    // Relasi ke Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
