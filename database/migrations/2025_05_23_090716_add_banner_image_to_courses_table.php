<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBannerImageToCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('banner_image')->nullable(); // Menambahkan kolom banner_image
            $table->string('whatsapp_link')->nullable()->after('deskripsi'); // Menambahkan kolom whatsapp_link setelah deskripsi
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['banner_image', 'whatsapp_link']);
        });
    }
}
