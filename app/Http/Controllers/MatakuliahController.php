<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    // Menampilkan daftar matakuliah
    public function index()
    {
        $matakuliahs = Matakuliah::all();
        return view('indexMatakuliah', compact('matakuliahs'));
    }

    // Menampilkan form tambah matakuliah
    public function create()
    {
        return view('createMatakuliah');
    }

    // Simpan data matakuliah baru
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:matakuliahs,kode',
            'nama_matakuliah' => 'required'
        ]);

        Matakuliah::create($request->all());

        return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit(Matakuliah $matakuliah)
    {
        return view('createMatakuliah', compact('matakuliah'));
    }

    // Update data matakuliah
    public function update(Request $request, Matakuliah $matakuliah)
    {
        $request->validate([
            'kode' => 'required|unique:matakuliahs,kode,' . $matakuliah->id,
            'nama_matakuliah' => 'required'
        ]);

        $matakuliah->update($request->all());

        return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil diupdate.');
    }

    // Hapus matakuliah
    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil dihapus.');
    }
}
