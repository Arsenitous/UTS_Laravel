<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::create([
            'NIM' => '202301001',
            'name' => 'Rizky Pratama',
            'tempat_lahir' => 'Medan',
            'tanggal_lahir' => '2003-02-12',
            'jurusan' => 'Sistem dan Teknologi Informasi',
            'angkatan' => '2023',
        ]);

        Mahasiswa::create([
            'NIM' => '202301002',
            'name' => 'Putri Ayu',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2004-04-23',
            'jurusan' => 'Bisnis Digital',
            'angkatan' => '2023',
        ]);

        Mahasiswa::create([
            'NIM' => '202301003',
            'name' => 'Andi Saputra',
            'tempat_lahir' => 'Surabaya',
            'tanggal_lahir' => '2003-08-09',
            'jurusan' => 'Kewirausahaan',
            'angkatan' => '2023',
        ]);
    }
}
