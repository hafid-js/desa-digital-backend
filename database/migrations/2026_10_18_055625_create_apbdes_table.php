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
        Schema::create('apbdes', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('section')->comment('pelaksanaan, pendapatan, pembelanjaan');
            $table->unsignedBigInteger('jumlah_realisasi')->default(0);
            $table->unsignedBigInteger('jumlah_target')->default(0);
            $table->decimal('persentase', 5, 2)->default(0);
            $table->unsignedInteger('tahun_anggaran');
            $table->timestamps();

            $table->index('tahun_anggaran');
            $table->index('section');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apbdes');
    }
};
