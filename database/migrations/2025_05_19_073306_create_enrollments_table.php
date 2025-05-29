<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentsTable extends Migration
{
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();

            // Relasi ke user (student) dan course
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');

            // Bukti transfer & status pembayaran
            $table->string('bukti_transfer')->nullable(); // path file bukti pembayaran
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('paid_at')->nullable(); // waktu pembayaran

            $table->timestamps();

            // Prevent duplicate enrollment (1 student, 1 course)
            $table->unique(['student_id', 'course_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('enrollments');
    }
}
