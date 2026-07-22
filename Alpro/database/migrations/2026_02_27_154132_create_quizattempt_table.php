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
    Schema::create('quizattempts', function (Blueprint $table) {
        $table->id();

        // relasi ke users
        $table->foreignId('user_id')
              ->constrained()
              ->onDelete('cascade');

        // relasi ke kuis
        $table->foreignId('kuis_id')
              ->constrained('kuis') // sesuaikan kalau nama tabel kuis beda
              ->onDelete('cascade');

        // skor
        $table->integer('score')->default(0);

        // waktu submit
        $table->timestamp('submitted_at')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('quizattempt', function (Blueprint $table) {
        });
        Schema::dropIfExists('quizattempt');
    }
};
