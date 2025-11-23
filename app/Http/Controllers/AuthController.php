<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // ====== LOGIN ======
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'NIM'      => 'required|string',
            'password' => 'required|string',
        ]);

        $mahasiswa = Mahasiswa::where('NIM', $request->NIM)->first();

        if (! $mahasiswa || ! $mahasiswa->login) {
            return back()->withErrors(['NIM' => 'Akun belum terdaftar.'])->withInput();
        }

        // TANPA HASH
        if ($request->password !== $mahasiswa->login->password) {
            return back()->withErrors(['password' => 'Password salah.'])->withInput();
        }

        // simpan di session
        session([
            'mahasiswa_id' => $mahasiswa->id,
            'mahasiswa_nim' => $mahasiswa->NIM,
            'mahasiswa_name' => $mahasiswa->name,
        ]);

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Berhasil login!');
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('login')
                         ->with('success', 'Berhasil logout.');
    }

    // ====== SIGN UP ======
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:100',
            'NIM'           => 'required|string|max:20|unique:mahasiswas',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jurusan'       => 'required|string',
            'angkatan'      => 'required|string|max:10',
            'password'      => 'required|string|min:6|confirmed',
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

        // 2. buat akun login TANPA HASH
        Login::create([
            'mahasiswa_id' => $mahasiswa->id,
            'password'     => $request->password,
        ]);

        return redirect()->route('login')
                         ->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
}
