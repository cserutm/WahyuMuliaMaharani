 
        {{-- Sidebar --}}
        <aside class="w-64 bg-white shadow-lg flex flex-col justify-between">
            <div>
{{-- Navigasi --}}
<nav class="flex flex-col space-y-2 px-6">
    <!-- Home / AlPro -->
    <a href="{{ route('guru.dashboard') }}" class="flex items-center space-x-2 text-blue-600 font-semibold">
        <!-- Ikon Home (Baru) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h5m4 0h5a1 1 0 001-1V10" />
        </svg>
        <span>Dashboard</span>
    </a>

    <!-- Materi -->
    <a href="{{ route('guru.modul.index') }}" 
    class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
        <!-- Ikon Document Text (ganti Book) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M7 8h10M7 12h6m2 8H7a2 2 0 01-2-2V6a2 2 0 012-2h7l4 4v12a2 2 0 01-2 2z" />
        </svg>
        <span>Kelola Materi</span>
    </a>

    <!-- Evaluasi -->
    <a href="{{ route('guru.quiz.index') }}" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
        <!-- Ikon Clock -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>Kelola Kuis</span>
    </a>

    <!-- Lihat Nilai-->
    <a href="{{ route('guru.nilai') }}" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
        <!-- Ikon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
       <path stroke-linecap="round" stroke-linejoin="round"
             d="M9 17v-2m3 2v-4m3 4v-6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z" />
   </svg>
        <span>Lihat Nilai</span>
    </a>

    <!-- Leaderboard -->
    <a href="{{ route('leaderboard') }}" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
        <!-- Ikon Trophy -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M8 21h8m-4-4v4m5-10a5 5 0 01-10 0V4h10v7z" />
        </svg>
        <span>Leaderboard siswa</span>
    </a>
</nav>   
            </div>
        </aside>