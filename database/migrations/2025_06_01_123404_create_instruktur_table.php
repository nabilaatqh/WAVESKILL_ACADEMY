<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrukturTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('instruktur', function (Blueprint $table) {
        $table->id();
        $table->string('nama_awal');
        $table->string('nama_akhir')->nullable();
        $table->string('email')->unique();
        $table->string('telepon');
        $table->string('tempat_lahir');
        $table->date('tanggal_lahir');
        $table->string('domisili')->nullable();
        $table->text('tentang_saya')->nullable();
        $table->string('foto')->nullable();
        $table->string('password');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instruktur');
    }
}
