<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        // Buat tabel courses
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('nama_course');
            $table->unsignedBigInteger('instruktur_id')->nullable(); // Foreign key instruktur
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            // Foreign key instruktur_id mengacu pada tabel users (instruktur)
            $table->foreign('instruktur_id')
                ->references('id')->on('users')
                ->where('role', 'instruktur') // Pastikan hanya instruktur yang dapat dipilih
                ->onDelete('set null');
        });

        // Buat pivot table course_student
        Schema::create('course_student', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id'); // Kolom untuk relasi ke courses
            $table->unsignedBigInteger('student_id'); // Kolom untuk relasi ke users (sebagai student)
            $table->timestamps();

            // Foreign key ke course dan student (hanya student yang memiliki role 'student')
            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->onDelete('cascade'); // Delete course, delete relasi

            $table->foreign('student_id')
                ->references('id')->on('users') // Students ada di tabel users
                ->where('role', 'student') // Pastikan hanya student yang dapat dipilih
                ->onDelete('cascade'); // Delete student, delete relasi
        });
    }

    public function down()
    {
        // Drop foreign key di courses terlebih dahulu
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['instruktur_id']);
        });

        // Hapus pivot table dan tabel courses
        Schema::dropIfExists('course_student');
        Schema::dropIfExists('courses');
    }
}
