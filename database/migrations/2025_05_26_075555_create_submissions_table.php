<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('project_id');
            $table->string('file');
            $table->text('catatan')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();

            // Foreign Key
           // $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
           // $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('submissions');
    }
}
