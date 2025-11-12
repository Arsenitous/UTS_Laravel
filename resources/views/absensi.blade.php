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

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4 items-end">
          {{-- Tanggal Absensi --}}
          <div>
            <label class="block font-medium text-gray-700 mb-2">Tanggal Absensi</label>
            <input type="date" name="tanggal_absensi"
                   value="{{ $selected_tanggal ?? '' }}"
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
                <option value="{{ $mk->id }}" {{ (isset($selected_mk) && $selected_mk == $mk->id) ? 'selected' : '' }}>
                  {{ $mk->nama_matakuliah }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Tombol Tampilkan --}}
          <div class="flex justify-start md:justify-end">
            <button type="submit" name="action" value="show"
                    class="bg-gray-600 hover:bg-gray-700 text-white w-full md:w-auto px-8 py-3 rounded-xl shadow-md transition-all duration-200">
              👀 Tampilkan
            </button>
          </div>
        </div>

        {{-- Tabel Mahasiswa / Pesan --}}
        @if(isset($showTable) && $showTable)
          <div class="bg-white shadow-md rounded-2xl border border-gray-200 mt-8 overflow-hidden">
            <table class="w-full text-center border-collapse">
              <thead class="bg-blue-600 text-white">
                <tr>
                  <th class="py-3 px-4 w-12">#</th>
                  <th class="py-3 px-4 text-left">Nama Mahasiswa</th>
                  <th class="py-3 px-4">Kehadiran</th>
                  <th class="py-3 px-4">Status</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                @foreach ($mahasiswas as $index => $mhs)
                  @php
                    $absen = isset($absensis)
                        ? $absensis->firstWhere('mahasiswa_id', $mhs->id)
                        : null;
                    $status = $absen->status_absen ?? '-';
                    $badgeColor = match($status) {
                        'H' => 'bg-green-100 text-green-700 border-green-400',
                        'A' => 'bg-red-100 text-red-700 border-red-400',
                        'I' => 'bg-yellow-100 text-yellow-700 border-yellow-400',
                        'S' => 'bg-blue-100 text-blue-700 border-blue-400',
                        default => 'bg-gray-100 text-gray-600 border-gray-300',
                    };
                  @endphp

               <tr class="hover:bg-gray-50 transition">
      <td class="py-3 px-4 font-medium text-gray-700">{{ $index + 1 }}</td>
      
      {{-- Kolom Nama + NIM --}}
      <td class="py-3 px-4 text-left">
        <div>
          <div class="font-medium text-gray-800">{{ $mhs->name }}</div>
          <div class="text-sm text-gray-500">{{ $mhs->NIM }}</div>
        </div>
      </td>

      {{-- Kolom Kehadiran --}}
      <td class="py-3 px-4">
        <span class="px-3 py-1 border rounded-full text-sm font-semibold {{ $badgeColor }}">
          {{ $status }}
        </span>
      </td>
                    {{-- Kolom Radio Button --}}
                    <td class="py-3 px-4">
                      <div class="flex justify-center gap-4">
                        @foreach (['H', 'A', 'I', 'S'] as $st)
                          <label class="flex items-center gap-1">
                            <input type="radio" name="status[{{ $mhs->id }}]" value="{{ $st }}"
                                   {{ $absen && $absen->status_absen == $st ? 'checked' : '' }}>
                            <span>{{ $st }}</span>
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
            <button type="submit" name="action" value="save"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl shadow-md transition-all duration-200">
              💾 Simpan Absensi
            </button>
          </div>
        @else
          {{-- Pesan Sebelum Tampilkan --}}
          <div class="mt-10 bg-yellow-100 border border-yellow-300 text-yellow-800 px-6 py-4 rounded-xl text-center">
            ⚠️ Silakan pilih tanggal dan mata kuliah terlebih dahulu, lalu klik <strong>"Tampilkan"</strong> untuk melihat daftar mahasiswa.
          </div>
        @endif
      </form>
    </div>
  </div>
</body>
</html>
