<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Absensi Mahasiswa</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">
  @include('layouts.navbar')

  <div class="max-w-6xl mx-auto py-10 px-6">
    {{-- Notifikasi Sukses --}}
@if (session('success'))
  <div class="mb-6">
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl shadow-sm flex items-center justify-between">
      <span>✅ {{ session('success') }}</span>
      <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800 font-bold">✖</button>
    </div>
  </div>
@endif
    {{-- Judul --}}
    <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-200 mb-8">
      <div class="flex items-center gap-3 mb-3">
        <span class="text-3xl">📝</span>
        <h1 class="text-3xl font-semibold text-gray-800">Absensi Mahasiswa</h1>
      </div>

      {{-- Form Input --}}
      <form action="{{ route('absensi.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-4">
          {{-- Tanggal Absensi --}}
          <div>
            <label class="block font-medium text-gray-700 mb-2">Tanggal Absensi</label>
            <input type="date" name="tanggal_absensi"
                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                   required>
          </div>

          {{-- Pilih Mata Kuliah --}}
          <div>
            <label class="block font-medium text-gray-700 mb-2">Pilih Mata Kuliah</label>
            <select name="matakuliah_id"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                    required>
              <option value="">-- Pilih Mata Kuliah --</option>
              @foreach ($matakuliahs as $mk)
                <option value="{{ $mk->id }}">{{ $mk->nama_matakuliah }}</option>
              @endforeach
            </select>
          </div>
        </div>

        {{-- Tabel Mahasiswa --}}
        <div class="bg-white shadow-md rounded-2xl border border-gray-200 mt-8">
          <table class="w-full text-center border-collapse">
            <thead class="bg-blue-600 text-white">
              <tr>
                <th class="py-3 px-4 rounded-tl-2xl w-12">#</th>
                <th class="py-3 px-4 text-left">Nama Mahasiswa</th>
                <th class="py-3 px-4 rounded-tr-2xl">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              @foreach ($mahasiswas as $index => $mhs)
              <tr class="hover:bg-gray-50 transition">
                <td class="py-3 px-4 font-medium text-gray-700">{{ $index + 1 }}</td>
                <td class="py-3 px-4 text-left">{{ $mhs->name }}</td>
                <td class="py-3 px-4">
                  <div class="flex justify-center gap-4">
                    @foreach (['H', 'A', 'I', 'S'] as $status)
                      <label class="flex items-center gap-1">
                        <input type="radio" name="status[{{ $mhs->id }}]" value="{{ $status }}" required>
                        <span>{{ $status }}</span>
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
        <div class="flex justify-center mt-8">
          <button type="submit"
                  class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl shadow-md transition-all duration-200">
            💾 Simpan Absensi
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
