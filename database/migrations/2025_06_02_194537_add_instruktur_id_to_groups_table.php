<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInstrukturIdToGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->foreignId('instruktur_id')->after('course_id')->constrained('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropForeign(['instruktur_id']);
            $table->dropColumn('instruktur_id');
        });
    }
}
