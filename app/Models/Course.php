<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Tambahkan kolom yang bisa diisi
    protected $fillable = ['nama_course', 'instruktur_id', 'deskripsi'];

    // Relasi ke instruktur (User dengan role 'instructor')
    public function instruktur()
    {
        return $this->belongsTo(User::class, 'instruktur_id')->where('role', 'instructor');
    }

    // Relasi many to many ke student (User dengan role 'student')
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'student_id')->where('role', 'student');
    }
}
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
