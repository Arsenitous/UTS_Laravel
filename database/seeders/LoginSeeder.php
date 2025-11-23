<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\Login;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua mahasiswa
        $mahasiswas = Mahasiswa::all();

        foreach ($mahasiswas as $index => $mhs) {

            // password simple berdasarkan urutan
            $password = 'pass00' . ($index + 1);

            Login::create([
                'mahasiswa_id' => $mhs->id,
                'password' => $password,   // tanpa hash
            ]);
        }
    }
}
