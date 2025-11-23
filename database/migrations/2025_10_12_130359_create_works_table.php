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
        Schema::create('works', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('posisi');
            $table->string('level');
            $table->string('jenis');
            $table->string('tipe');
            $table->string('lokasi');
            $table->integer('gaji');
            $table->text('deskripsi');
            $table->text('kualifikasi');
            $table->uuid('data_program_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('data_program_id')->references('id')->on('data_programs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
