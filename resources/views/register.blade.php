<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up Mahasiswa</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
  @include('layouts.navbar')

  <main class="flex-1 flex items-center justify-center py-12">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-2xl border border-gray-200">
      <h1 class="text-3xl font-bold text-center text-blue-700 mb-6">
        ➕ Daftar Akun Mahasiswa
      </h1>

      {{-- Pesan Error --}}
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

      <form method="POST" action="{{ route('register.post') }}">
        @csrf

        {{-- Nama --}}
        <div class="mb-4">
          <label class="block font-medium mb-1">Nama</label>
          <input type="text" name="name" value="{{ old('name') }}"
                 class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-300 focus:outline-none">
        </div>

        {{-- NIM --}}
        <div class="mb-4">
          <label class="block font-medium mb-1">NIM</label>
          <input type="text" name="NIM" value="{{ old('NIM') }}"
                 class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-300 focus:outline-none">
        </div>

        {{-- Tempat Lahir --}}
        <div class="mb-4">
          <label class="block font-medium mb-1">Tempat Lahir</label>
          <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                 class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-300 focus:outline-none">
        </div>

        {{-- Tanggal Lahir --}}
        <div class="mb-4">
          <label class="block font-medium mb-1">Tanggal Lahir</label>
          <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                 class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-300 focus:outline-none">
        </div>

        {{-- Jurusan --}}
        <div class="mb-4">
          <label class="block font-medium mb-1">Jurusan</label>
          @php $jurusan = old('jurusan'); @endphp
          <div class="space-y-2">
            <label class="flex items-center gap-2">
              <input type="radio" name="jurusan" value="Bisnis Digital"
                     {{ $jurusan == 'Bisnis Digital' ? 'checked' : '' }}>
              <span>Bisnis Digital</span>
            </label>
            <label class="flex items-center gap-2">
              <input type="radio" name="jurusan" value="Kewirausahaan"
                     {{ $jurusan == 'Kewirausahaan' ? 'checked' : '' }}>
              <span>Kewirausahaan</span>
            </label>
            <label class="flex items-center gap-2">
              <input type="radio" name="jurusan" value="Sistem dan Teknologi Informasi"
                     {{ $jurusan == 'Sistem dan Teknologi Informasi' ? 'checked' : '' }}>
              <span>Sistem dan Teknologi Informasi</span>
            </label>
          </div>
        </div>

        {{-- Angkatan --}}
        <div class="mb-4">
          <label class="block font-medium mb-1">Angkatan</label>
          <input type="text" name="angkatan" value="{{ old('angkatan') }}"
                 class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-300 focus:outline-none">
        </div>

        <hr class="my-6">

        {{-- Password --}}
        <div class="mb-4">
          <label class="block font-medium mb-1">Password</label>
          <input type="password" name="password"
                 class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-300 focus:outline-none">
        </div>

        {{-- Konfirmasi Password --}}
        <div class="mb-6">
          <label class="block font-medium mb-1">Konfirmasi Password</label>
          <input type="password" name="password_confirmation"
                 class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-300 focus:outline-none">
        </div>

        <div class="flex justify-between items-center">
          <a href="{{ route('login') }}"
             class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow transition">
            ← Kembali ke Login
          </a>

          <button type="submit"
                  class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
            Daftar
          </button>
        </div>
      </form>
    </div>
  </main>
</body>
</html>
