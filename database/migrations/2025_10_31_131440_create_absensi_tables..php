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

            // Relasi ke tabel mahasiswa
            $table->foreignId('mahasiswa_id')
                  ->constrained('mahasiswas')
                  ->onDelete('cascade');

            // Relasi ke tabel matakuliah (optional)
            $table->char('matakuliah_id', 36)->nullable(); // ← tambahkan nullable()
            $table->foreign('matakuliah_id')
                  ->references('id')
                  ->on('matakuliahs')
                  ->onDelete('cascade');

            $table->date('tanggal_absensi')->default(now());
            $table->enum('status_absen', ['A', 'H', 'I', 'S'])->default('A');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
