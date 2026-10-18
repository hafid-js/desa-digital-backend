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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_laporan')->unique()->comment('mis. PGD-2026-0001');
            $table->string('nama_pelapor');
            $table->string('nik_pelapor')->nullable();
            $table->string('wilayah')->comment('dusun/desa');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->text('rincian')->comment('minimal 50 karakter');
            $table->enum('visibilitas', ['private', 'public'])->default('private');
            $table->enum('status', ['diterima', 'diproses', 'selesai', 'ditolak'])->default('diterima');
            $table->text('tanggapan')->nullable()->comment('dari petugas desa');
            $table->datetime('waktu_kejadian')->nullable();
            $table->string('lampiran_foto')->nullable();
            $table->string('lampiran_pdf')->nullable();
            $table->string('lampiran_video')->nullable();
            $table->timestamps();

            $table->index('kode_laporan');
            $table->index('status');
            $table->index('wilayah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
