<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pertanyaan', function (Blueprint $table) {
            $table->string('gambar_soal')->nullable()->after('soal');

            $table->string('gambar_opsi_a')->nullable()->after('opsi_a');
            $table->string('gambar_opsi_b')->nullable()->after('opsi_b');
            $table->string('gambar_opsi_c')->nullable()->after('opsi_c');
            $table->string('gambar_opsi_d')->nullable()->after('opsi_d');
            $table->string('gambar_opsi_e')->nullable()->after('opsi_e');
        });
    }

    public function down(): void
    {
        Schema::table('pertanyaan', function (Blueprint $table) {
            $table->dropColumn([
                'gambar_soal',
                'gambar_opsi_a',
                'gambar_opsi_b',
                'gambar_opsi_c',
                'gambar_opsi_d',
                'gambar_opsi_e'
            ]);
        });
    }
};
