<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Absensi;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        $matakuliahs = Matakuliah::all();
        return view('absensi', compact('mahasiswas', 'matakuliahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_absensi' => 'required|date',
            'matakuliah_id' => 'required|exists:matakuliahs,id',
            'status' => 'required|array',
        ]);

        foreach ($request->status as $mahasiswa_id => $status_absen) {
            Absensi::create([
                'mahasiswa_id' => $mahasiswa_id,
                'matakuliah_id' => $request->matakuliah_id,
                'tanggal_absensi' => $request->tanggal_absensi,
                'status_absen' => $status_absen,
            ]);
        }

        return redirect()->back()->with('success', 'Absensi berhasil disimpan!');
    }
}
