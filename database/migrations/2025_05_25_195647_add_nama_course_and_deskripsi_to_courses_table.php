<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamaCourseAndDeskripsiToCoursesTable extends Migration
{
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('nama_course')->after('id');
            $table->text('deskripsi')->nullable()->after('nama_course');
        });
    }

    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('nama_course');
            $table->dropColumn('deskripsi');
        });
    }
}