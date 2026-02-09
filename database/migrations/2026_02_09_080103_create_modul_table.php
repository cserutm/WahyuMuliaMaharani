<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('modul', function (Blueprint $table) {
            $table->id();
              $table->string('judul');
            $table->text('deskripsi');
            $table->text('tujuan_pembelajaran');
            $table->string('file_materi'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('modul', function (Blueprint $table) {
        });
        Schema::dropIfExists('modul');
    }
};
