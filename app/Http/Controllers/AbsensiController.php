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
        $mahasiswas = Mahasiswa::all();
        $matakuliahs = Matakuliah::all();

        // Saat pertama kali halaman dibuka, tabel belum ditampilkan
        $showTable = false;

        return view('absensi', compact('mahasiswas', 'matakuliahs', 'showTable'));
    }

    // simpan atau tampilkan data absensi
    public function store(Request $request)
    {
        $request->validate([
            'matakuliah_id' => 'required',
            'tanggal_absensi' => 'required|date',
        ]);

        // === Jika tombol yang ditekan adalah "Tampilkan" ===
        if ($request->action === 'show') {
            $absensis = Absensi::where('matakuliah_id', $request->matakuliah_id)
                ->where('tanggal_absensi', $request->tanggal_absensi)
                ->get();

            $mahasiswas = Mahasiswa::all();
            $matakuliahs = Matakuliah::all();

            $showTable = true; // <--- Tabel baru muncul

            return view('absensi', compact('mahasiswas', 'matakuliahs', 'absensis', 'showTable'))
                ->with('selected_mk', $request->matakuliah_id)
                ->with('selected_tanggal', $request->tanggal_absensi);
        }

        // === Jika tombol yang ditekan adalah "Simpan" ===
        $request->validate(['status' => 'required|array']);

        foreach ($request->status as $mahasiswa_id => $status) {
            $existing = Absensi::where('mahasiswa_id', $mahasiswa_id)
                ->where('matakuliah_id', $request->matakuliah_id)
                ->where('tanggal_absensi', $request->tanggal_absensi)
                ->first();

            if ($existing) {
                $existing->update(['status_absen' => $status]);
            } else {
                Absensi::create([
                    'mahasiswa_id' => $mahasiswa_id,
                    'matakuliah_id' => $request->matakuliah_id,
                    'tanggal_absensi' => $request->tanggal_absensi,
                    'status_absen' => $status,
                ]);
            }
        }

        return redirect()->route('absensi.create')->with('success', 'Absensi berhasil disimpan!');
    }
}
