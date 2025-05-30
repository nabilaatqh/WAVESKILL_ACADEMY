<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas');
            $table->text('deskripsi')->nullable();
            $table->string('banner')->nullable();
            $table->unsignedBigInteger('instruktur_id')->nullable();
            $table->timestamps();

            // Foreign key (pastikan tabel instrukturs atau users sudah ada)
            $table->foreign('instruktur_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
