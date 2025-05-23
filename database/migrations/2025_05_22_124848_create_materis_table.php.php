<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterisTable extends Migration
{
    public function up()
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id'); // relasi ke courses
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('tipe')->nullable(); // misal 'video', 'pdf'
            $table->string('file')->nullable(); // file path jika ada
            $table->string('link')->nullable(); // link video jika ada
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('materis');
    }
}
