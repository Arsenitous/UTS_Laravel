<nav class="bg-blue-600 text-white shadow-md">
  <div class="container mx-auto px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-bold flex items-center gap-2">
      <span class="w-3 h-3 bg-cyan-300 rounded"></span>
      Sistem Akademik
    </h1>
    <div class="space-x-6">
      <a href="{{ route('mahasiswa.index') }}" 
         class="hover:text-cyan-300 transition">Mahasiswa</a>
      <a href="{{ route('absensi.index') }}" 
         class="hover:text-cyan-300 transition">Absensi</a>
    </div>
  </div>
</nav>
