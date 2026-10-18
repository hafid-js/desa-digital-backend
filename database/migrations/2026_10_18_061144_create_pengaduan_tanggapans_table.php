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
        Schema::create('pengaduan_tanggapans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id')->constrained('pengaduans')->cascadeOnDelete();
            $table->text('tanggapan');
            $table->enum('status_sebelum', ['diterima', 'diproses', 'selesai', 'ditolak'])->nullable();
            $table->enum('status_sesudah', ['diterima', 'diproses', 'selesai', 'ditolak'])->nullable();
            $table->string('diberi_oleh')->comment('nama petugas desa');
            $table->timestamps();

            $table->index('pengaduan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan_tanggapans');
    }
};
