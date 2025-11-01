<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mahasiswa_id')
                  ->constrained('mahasiswas')
                  ->onDelete('cascade');

            $table->foreignId('matakuliah_id')
                  ->constrained('matakuliahs')
                  ->onDelete('cascade');

            $table->date('tanggal_absensi')->nullable();
            $table->enum('status_absen', ['A', 'H', 'I', 'S'])->default('A');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
