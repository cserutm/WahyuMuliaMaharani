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
    Schema::create('pertanyaan', function (Blueprint $table) {
        $table->id();

        // Foreign Key ke tabel kuis
        $table->foreignId('kuis_id')
              ->constrained('kuis')
              ->onDelete('cascade');

        $table->text('soal');

        $table->string('opsi_a');
        $table->string('opsi_b');
        $table->string('opsi_c');
        $table->string('opsi_d');
        $table->string('opsi_e')->nullable(); // kalau tidak wajib

        $table->enum('jawaban_benar', ['a','b','c','d','e']);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('pertanyaan', function (Blueprint $table) {
        });
        Schema::dropIfExists('pertanyaan');
    }
};
