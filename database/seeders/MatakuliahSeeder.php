<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MatakuliahSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode' => 'MK001', 'nama_matakuliah' => 'Pemrograman Web'],
            ['kode' => 'MK002', 'nama_matakuliah' => 'Basis Data'],
            ['kode' => 'MK003', 'nama_matakuliah' => 'Kecerdasan Buatan'],
            ['kode' => 'MK004', 'nama_matakuliah' => 'Jaringan Komputer'],
            ['kode' => 'MK005', 'nama_matakuliah' => 'Sistem Operasi'],
            ['kode' => 'MK006', 'nama_matakuliah' => 'Pemrograman Mobile'],
            ['kode' => 'MK007', 'nama_matakuliah' => 'Rekayasa Perangkat Lunak'],
            ['kode' => 'MK008', 'nama_matakuliah' => 'Algoritma dan Struktur Data'],
        ];

        foreach ($data as $item) {
            DB::table('matakuliahs')->insert([
                'kode' => $item['kode'],
                'nama_matakuliah' => $item['nama_matakuliah'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
