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
        Schema::create('pengaduan_lampiran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id')->constrained('pengaduans')->cascadeOnDelete();
            $table->enum('tipe', ['foto', 'pdf', 'video'])->default('foto');
            $table->string('path')->comment('path file di storage');
            $table->string('nama_asli')->nullable()->comment('nama file asli dari user');
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();

            $table->index(['pengaduan_id', 'tipe']);
            $table->index('urutan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan_lampiran');
    }
};
