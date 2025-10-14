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
            $table->string('sub_judul')->nullable();
            $table->text('deskripsi')->nullable();
            $table->date('waktu_pelaksanaan')->nullable();
            $table->integer('tahun_anggaran')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('status_proyek')->nullable();
            $table->json('dokumentasi')->nullable();
            $table->uuid('kategori_id')->unique();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('categories')->onDelete('cascade');
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
