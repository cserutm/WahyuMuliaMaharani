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
    Schema::create('semesters', function (Blueprint $table) {
    $table->id();
    $table->string('nama_semester'); // Ganjil / Genap
    $table->string('tahun_ajaran'); // 2024/2025
    $table->foreignId('created_by')->constrained('users');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('semesters', function (Blueprint $table) {
        });
        Schema::dropIfExists('semesters');
    }
};
