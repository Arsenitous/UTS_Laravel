<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Login;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return view('indexMahasiswa', compact('mahasiswas'));
    }

    public function create()
    {
        return view('createMahasiswa');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:100',
            'NIM'           => 'required|string|max:20|unique:mahasiswas',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jurusan'       => 'required|string',
            'angkatan'      => 'required|string|max:10',
            'password'      => 'required|string|min:4', // boleh kamu ganti min-nya
        ]);

        // 1. buat data mahasiswa
        $mahasiswa = Mahasiswa::create([
            'name'          => $request->name,
            'NIM'           => $request->NIM,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jurusan'       => $request->jurusan,
            'angkatan'      => $request->angkatan,
        ]);

        // 2. buat akun login (tanpa hash)
        Login::create([
            'mahasiswa_id' => $mahasiswa->id,
            'password'     => $request->password,
        ]);

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data mahasiswa & akun login berhasil ditambahkan!');
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('createMahasiswa', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'name'          => 'required|string|max:100',
            'NIM'           => 'required|string|max:20|unique:mahasiswas,NIM,' . $id,
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jurusan'       => 'required|string',
            'angkatan'      => 'required|string|max:10',
            'password'      => 'nullable|string|min:6', // bisa kosong saat edit
        ]);

        // 1. update data mahasiswa
        $mahasiswa->update([
            'name'          => $request->name,
            'NIM'           => $request->NIM,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jurusan'       => $request->jurusan,
            'angkatan'      => $request->angkatan,
        ]);

        // 2. kalau password diisi, update / buat akun login
        if ($request->filled('password')) {
            if ($mahasiswa->login) {
                // kalau sudah punya akun login, update
                $mahasiswa->login->update([
                    'password' => $request->password,
                ]);
            } else {
                // kalau belum punya (misalnya dari seeder lama), buat baru
                Login::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'password'     => $request->password,
                ]);
            }
        }

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete(); // login ikut kehapus karena FK cascadeOnDelete di migration

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}
