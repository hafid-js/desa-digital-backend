<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artikel_lampiran', function (Blueprint $table) {
            $table->id();

            $table->foreignId('artikel_id')
                ->constrained('artikels')
                ->cascadeOnDelete();

            $table->string('path');
            $table->string('nama_asli');
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikel_lampiran');
    }
};
