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
        Schema::table('modul', function (Blueprint $table) {
            $table->text('ringkasan')->nullable();

            $table->text('poin_penting')->nullable();

            $table->text('fakta_menarik')->nullable();

            $table->string('gambar_materi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modul', function (Blueprint $table) {
            $table->dropColumn([
                'ringkasan',
                'poin_penting',
                'fakta_menarik',
                'gambar_materi'
            ]);
        });
    }
};
