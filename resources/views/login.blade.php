<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Mahasiswa</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

  @include('layouts.navbar')

  <main class="flex-1 flex items-center justify-center py-12">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md border border-gray-200">
      <h1 class="text-3xl font-bold text-center text-blue-700 mb-6">🔐 Login</h1>

      {{-- Pesan sukses / error --}}
      @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-800 rounded">
          {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-800 rounded">
          {{ session('error') }}
        </div>
      @endif

      @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-800 rounded">
          <ul class="list-disc pl-5">
            @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div class="mb-4">
          <label class="block font-medium mb-1">NIM</label>
          <input type="text" name="NIM" value="{{ old('NIM') }}"
                 class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-300 focus:outline-none">
        </div>

        <div class="mb-6">
          <label class="block font-medium mb-1">Password</label>
          <input type="password" name="password"
                 class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-300 focus:outline-none">
        </div>

        <button type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg shadow transition">
          Login
        </button>
      </form>

      <p class="mt-4 text-center text-sm text-gray-600">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Sign up</a>
      </p>
    </div>
  </main>
</body>
</html>
