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
        Schema::create('data_programs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('judul');
            $table->string('sub_judul');
            $table->text('deskripsi');
            $table->date('waktu_pelaksanaan');
            $table->integer('tahun_anggaran');
            $table->string('lokasi');
            $table->string('status_proyek');
            $table->json('dokumentasi');
            $table->uuid('kategori_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('categories');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_programs');
    }
};
