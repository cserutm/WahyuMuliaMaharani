<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('modul', function (Blueprint $table) {

            $table->foreignId('class_id')
                ->nullable()
                ->constrained('classes')
                ->cascadeOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('modul', function (Blueprint $table) {

            $table->dropForeign(['class_id']);
            $table->dropColumn('class_id');

        });
    }
};