<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    {{ isset($matakuliah) ? 'Edit Matakuliah' : 'Tambah Matakuliah' }}
  </title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
  @include('layouts.navbar')

  <main class="flex-1 flex items-center justify-center py-12">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-lg border border-gray-200">
      <h1 class="text-3xl font-bold text-center text-blue-700 mb-6">
        {{ isset($matakuliah) ? '✏️ Edit Matakuliah' : '➕ Tambah Matakuliah Baru' }}
      </h1>

      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
          <strong>Terjadi kesalahan:</strong>
          <ul class="list-disc pl-5 mt-2">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ isset($matakuliah) ? route('matakuliah.update', $matakuliah->id) : route('matakuliah.store') }}">
        @csrf
        @if(isset($matakuliah))
          @method('PUT')
        @endif

        <div class="mb-4">
          <label class="block font-medium mb-1">Kode</label>
          <input type="text" name="kode" 
                 value="{{ old('kode', $matakuliah->kode ?? '') }}"
                 class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-300 focus:outline-none">
        </div>

        <div class="mb-6">
          <label class="block font-medium mb-1">Nama Matakuliah</label>
          <input type="text" name="nama_matakuliah" 
                 value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah ?? '') }}"
                 class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-300 focus:outline-none">
        </div>

        <div class="flex justify-between">
          <a href="{{ route('matakuliah.index') }}" 
             class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow transition">
            ← Kembali
          </a>

          <button type="submit"
                  class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
            {{ isset($matakuliah) ? 'Update' : 'Create' }}
          </button>
        </div>
      </form>
    </div>
  </main>
</body>
</html>
