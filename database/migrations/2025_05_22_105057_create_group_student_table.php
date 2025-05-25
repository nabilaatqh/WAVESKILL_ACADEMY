<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupStudentTable extends Migration
{
    public function up()
    {
        Schema::create('group_student', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('student_id');
            $table->timestamps();

            // foreign key constraints
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');

            // agar tidak ada duplikat record untuk pasangan group dan student
            $table->unique(['group_id', 'student_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('group_student');
    }
}
