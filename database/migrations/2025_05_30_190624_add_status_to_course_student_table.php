<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToCourseStudentTable extends Migration
{
    public function up()
    {
        Schema::table('course_student', function (Blueprint $table) {
            $table->string('status')->default('pending'); // default status bisa kamu sesuaikan
        });
    }

    public function down()
    {
        Schema::table('course_student', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
