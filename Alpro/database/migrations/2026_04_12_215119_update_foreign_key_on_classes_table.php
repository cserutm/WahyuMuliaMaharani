<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('classes', function (Blueprint $table) {
            // Hapus foreign key lama
            $table->dropForeign(['semester_id']);

            // Tambah ulang dengan cascade
            $table->foreign('semester_id')
                  ->references('id')
                  ->on('semesters')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign(['semester_id']);

            // Balikin ke semula (restrict)
            $table->foreign('semester_id')
                  ->references('id')
                  ->on('semesters');
        });
    }
};