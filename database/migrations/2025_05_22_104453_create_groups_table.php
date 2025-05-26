<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('course_id'); // foreign key ke courses
            $table->string('title');                  // nama grup kelas
            $table->text('description')->nullable(); // deskripsi opsional
            $table->string('whatsapp_link')->nullable(); // link grup WA opsional
            
            $table->timestamps();

            // foreign key constraint
            $table->foreign('course_id')
                  ->references('id')->on('courses')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
