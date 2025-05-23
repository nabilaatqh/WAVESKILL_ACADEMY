<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('file')->nullable(); // jika ada upload file
            $table->timestamps();

            // Foreign key ke courses
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
