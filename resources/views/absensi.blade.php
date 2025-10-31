<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Absensi Mahasiswa</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">
  {{-- Navbar --}}
  @include('layouts.navbar')

  {{-- Container --}}
  <div class="container mx-auto py-10 px-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-gray-800">📅 Data Absensi Mahasiswa</h1>
    </div>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
      <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded-lg">
        {{ session('success') }}
      </div>
    @endif

    {{-- Form utama untuk menyimpan semua absensi --}}
    <form action="{{ route('absensi.store') }}" method="POST">
      @csrf

      {{-- Tabel Absensi --}}
      <div class="overflow-x-auto mb-6">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
          <thead class="bg-gray-800 text-white">
            <tr>
              <th class="py-3 px-4 text-left">No</th>
              <th class="py-3 px-4 text-left">Mahasiswa</th>
              <th class="py-3 px-4 text-left">Kehadiran Terakhir</th>
              <th class="py-3 px-4 text-center">Status Hari Ini</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($mahasiswas as $index => $mahasiswa)
              @php
                $absensiTerakhir = $mahasiswa->absensi->last();
              @endphp

              <tr class="border-t hover:bg-gray-50 transition">
                <td class="py-2 px-4">{{ $index + 1 }}</td>

                {{-- Nama + NIM --}}
                <td class="py-2 px-4">
                  <div class="font-semibold text-gray-800">{{ strtoupper($mahasiswa->name) }}</div>
                  <div class="text-sm text-gray-500">{{ $mahasiswa->NIM }}</div>
                </td>

                {{-- Kehadiran terakhir --}}
                <td class="py-2 px-4">
                  @if($absensiTerakhir)
                    @switch($absensiTerakhir->status_absen)
                      @case('H')
                        <span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full">Hadir</span>
                        @break
                      @case('A')
                        <span class="bg-red-100 text-red-700 text-sm px-3 py-1 rounded-full">Absen</span>
                        @break
                      @case('I')
                        <span class="bg-yellow-100 text-yellow-700 text-sm px-3 py-1 rounded-full">Izin</span>
                        @break
                      @case('S')
                        <span class="bg-blue-100 text-blue-700 text-sm px-3 py-1 rounded-full">Sakit</span>
                        @break
                      @default
                        <span class="text-gray-400 text-sm">-</span>
                    @endswitch
                  @else
                    <span class="text-gray-400 text-sm">-</span>
                  @endif
                </td>

                {{-- Input status baru --}}
                <td class="py-2 px-4 text-center space-x-2">
                  <div class="flex justify-center gap-4">
                    @foreach(['H','A','I','S'] as $status)
                      <label class="inline-flex items-center space-x-1">
                        <input type="radio" 
                               name="status[{{ $mahasiswa->id }}]" 
                               value="{{ $status }}"
                               class="text-blue-500 focus:ring-blue-400">
                        <span class="text-sm text-gray-700">{{ $status }}</span>
                      </label>
                    @endforeach
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      {{-- Tombol Simpan --}}
      <div class="flex justify-end">
        <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">
          💾 Simpan Absensi
        </button>
      </div>
    </form>
  </div>
</body>
</html>
