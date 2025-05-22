<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('instruktur_id')->after('id');
            $table->foreign('instruktur_id')->references('id')->on('instrukturs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['instruktur_id']);
            $table->dropColumn('instruktur_id');
        });
    }
};

