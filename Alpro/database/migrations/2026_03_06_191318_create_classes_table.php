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
    Schema::create('classes', function (Blueprint $table) {
    $table->id();
    $table->string('nama_kelas'); // X1, X2
    $table->foreignId('semester_id')->constrained();
    $table->foreignId('created_by')->constrained('users');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('classes', function (Blueprint $table) {
        });
        Schema::dropIfExists('classes');
    }
};
