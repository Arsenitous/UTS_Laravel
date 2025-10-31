<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::with('absensi')->get();
        return view('absensi', compact('mahasiswas'));
    }

    public function store(Request $request)
    {
        $statuses = $request->input('status', []);

        if (empty($statuses)) {
            return redirect()->back()->with('success', 'Tidak ada data absensi yang dipilih.');
        }

        foreach ($statuses as $mahasiswa_id => $status_absen) {
            Absensi::create([
                'mahasiswa_id' => $mahasiswa_id,
                'status_absen' => $status_absen,
                'tanggal' => now(),
            ]);
        }

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil disimpan!');
    }
}
