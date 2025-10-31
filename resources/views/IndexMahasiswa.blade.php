<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Mahasiswa</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">
  {{-- Navbar --}}
  @include('layouts.navbar')

  {{-- Container --}}
  <div class="container mx-auto py-10 px-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-gray-800">📋 Data Mahasiswa</h1>
      <a href="{{ route('mahasiswa.create') }}" 
         class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow transition">
         + Add Mahasiswa
      </a>
    </div>

    {{-- Tabel Data --}}
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
        <thead class="bg-gray-800 text-white">
          <tr>
            <th class="py-3 px-4 text-left">#</th>
            <th class="py-3 px-4 text-left">NIM</th>
            <th class="py-3 px-4 text-left">Nama</th>
            <th class="py-3 px-4 text-left">Tempat Lahir</th>
            <th class="py-3 px-4 text-left">Tanggal Lahir</th>
            <th class="py-3 px-4 text-left">Jurusan</th>
            <th class="py-3 px-4 text-left">Angkatan</th>
            <th class="py-3 px-4 text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($mahasiswas as $mahasiswa)
          <tr class="border-t hover:bg-gray-50 transition">
            <td class="py-2 px-4">{{ $loop->iteration }}</td>
            <td class="py-2 px-4">{{ $mahasiswa->NIM }}</td>
            <td class="py-2 px-4">{{ $mahasiswa->name }}</td>
            <td class="py-2 px-4">{{ $mahasiswa->tempat_lahir }}</td>
            <td class="py-2 px-4">{{ $mahasiswa->tanggal_lahir }}</td>
            <td class="py-2 px-4">{{ $mahasiswa->jurusan }}</td>
            <td class="py-2 px-4">{{ $mahasiswa->angkatan }}</td>
            <td class="py-2 px-4 text-center space-x-2">
              <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}" 
                 class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded shadow transition">
                 Edit
              </a>
              <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" 
                    method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        onclick="return confirm('Yakin mau hapus data ini?')"
                        class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded shadow transition">
                  Delete
                </button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="8" class="text-center py-4 text-gray-500">Belum ada data mahasiswa.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
