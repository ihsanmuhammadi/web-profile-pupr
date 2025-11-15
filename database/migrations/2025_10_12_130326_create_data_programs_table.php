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
            $table->date('waktu_mulai');
            $table->date('waktu_selesai');
            $table->integer('tahun_anggaran');
            $table->string('kecamatan');
            $table->string('lokasi');
            $table->string('status_proyek');
            $table->string('dokumentasi');
            $table->string('tenaga_kerja_1');
            $table->string('posisi_1');
            $table->string('tenaga_kerja_2');
            $table->string('posisi_2');
            $table->string('tenaga_kerja_3');
            $table->string('posisi_3');
            $table->string('tenaga_kerja_4');
            $table->string('posisi_4');
            $table->string('tenaga_kerja_5');
            $table->string('posisi_5');
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
