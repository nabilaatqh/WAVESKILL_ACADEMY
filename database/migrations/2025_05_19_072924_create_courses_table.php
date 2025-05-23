<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('nama_course');
            $table->text('deskripsi')->nullable();
            $table->string('banner')->nullable();
            $table->unsignedBigInteger('instruktur_id')->nullable();
            $table->timestamps();

            $table->foreign('instruktur_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
