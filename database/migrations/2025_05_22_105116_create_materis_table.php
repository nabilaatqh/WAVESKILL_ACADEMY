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
    $table->string('judul');
    $table->text('deskripsi')->nullable();
    $table->string('file')->nullable();
    $table->string('tipe');
    $table->unsignedBigInteger('course_id');
    $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
    $table->timestamps(); // ← penting
});

}


    public function down()
    {
        Schema::dropIfExists('materis');
    }
}
