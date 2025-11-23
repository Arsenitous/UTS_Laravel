<nav class="bg-blue-600 text-white shadow-md">
  <div class="container mx-auto px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-bold flex items-center gap-2">
      <span class="w-3 h-3 bg-cyan-300 rounded"></span>
      Sistem Akademik
    </h1>

    <div class="space-x-6 flex items-center">
      @if(session()->has('mahasiswa_id'))
        {{-- Menu utama, hanya jika sudah login --}}
        <a href="{{ route('mahasiswa.index') }}" class="hover:text-cyan-300 transition">Mahasiswa</a>
        <a href="{{ route('matakuliah.index') }}" class="hover:text-cyan-300 transition">Matakuliah</a>
        <a href="{{ route('absensi.create') }}" class="hover:text-cyan-300 transition">Absensi</a>

        <span class="text-sm text-cyan-200 ml-4">
          {{ session('mahasiswa_name') }} ({{ session('mahasiswa_nim') }})
        </span>

        <form action="{{ route('logout') }}" method="POST" class="inline ml-4">
          @csrf
          <button type="submit"
            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow text-sm">
            Logout
          </button>
        </form>
      @else
        {{-- Kalau belum login --}}
        <a href="{{ route('login') }}" class="hover:text-cyan-300 transition">Login</a>
        <a href="{{ route('register') }}" 
           class="bg-green-500 hover:bg-green-600 px-3 py-1 rounded-lg shadow text-sm">
          Sign Up
        </a>
      @endif
    </div>
  </div>
</nav>
