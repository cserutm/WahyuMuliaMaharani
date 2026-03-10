<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('modul', function (Blueprint $table) {
        $table->string('video_url')->nullable()->after('file_materi');
    });
}

public function down()
{
    Schema::table('modul', function (Blueprint $table) {
        $table->dropColumn('video_url');
    });
}
};
