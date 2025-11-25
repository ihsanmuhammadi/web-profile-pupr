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
        Schema::table('categories', function (Blueprint $table) {
             // Ubah tipe kolom menjadi text
            $table->text('description')->nullable()->change();
            $table->text('tujuan')->nullable()->change();
            $table->text('contoh_program_1')->nullable()->change();
            $table->text('contoh_program_2')->nullable()->change();
            $table->text('contoh_program_3')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('description')->nullable()->change();
            $table->string('tujuan')->nullable()->change();
            $table->string('contoh_program_1')->nullable()->change();
            $table->string('contoh_program_2')->nullable()->change();
            $table->string('contoh_program_3')->nullable()->change();
        });
    }
};
