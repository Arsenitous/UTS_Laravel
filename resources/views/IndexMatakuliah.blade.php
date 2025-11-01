<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Matakuliah</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">
  @include('layouts.navbar')

  <div class="container mx-auto py-10 px-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-gray-800">📋 Data Matakuliah</h1>
      <a href="{{ route('matakuliah.create') }}" 
         class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow transition">
         + Add Matakuliah
      </a>
    </div>

    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
      </div>
    @endif

    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
        <thead class="bg-gray-800 text-white">
          <tr>
            <th class="py-3 px-4 text-left">#</th>
            <th class="py-3 px-4 text-left">Kode</th>
            <th class="py-3 px-4 text-left">Nama Matakuliah</th>
            <th class="py-3 px-4 text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($matakuliahs as $matakuliah)
          <tr class="border-t hover:bg-gray-50 transition">
            <td class="py-2 px-4">{{ $loop->iteration }}</td>
            <td class="py-2 px-4">{{ $matakuliah->kode }}</td>
            <td class="py-2 px-4">{{ $matakuliah->nama_matakuliah }}</td>
            <td class="py-2 px-4 text-center space-x-2">
              <a href="{{ route('matakuliah.edit', $matakuliah->id) }}" 
                 class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded shadow transition">
                 Edit
              </a>
              <form action="{{ route('matakuliah.destroy', $matakuliah->id) }}" 
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
            <td colspan="4" class="text-center py-4 text-gray-500">Belum ada data matakuliah.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
