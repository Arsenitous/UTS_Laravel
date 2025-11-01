<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    // tampilkan halaman absensi
    public function create()
    {
        $mahasiswas = Mahasiswa::all();      // ambil semua mahasiswa
        $matakuliahs = Matakuliah::all();    // ambil semua matakuliah
        return view('absensi', compact('mahasiswas', 'matakuliahs'));
    }

    // simpan data absensi
    public function store(Request $request)
    {
        $request->validate([
            'matakuliah_id' => 'required',
            'tanggal_absensi' => 'required|date',
            'status' => 'required|array'
        ]);

        foreach ($request->status as $mahasiswa_id => $status) {
            Absensi::create([
                'mahasiswa_id' => $mahasiswa_id,
                'matakuliah_id' => $request->matakuliah_id,
                'tanggal_absensi' => $request->tanggal_absensi,
                'status_absen' => $status
            ]);
        }

        return redirect()->route('absensi.create')->with('success', 'Absensi berhasil disimpan!');
    }
}
