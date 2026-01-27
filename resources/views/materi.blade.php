<x-app-layout>
    {{-- Header slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- Dashboard Layout --}}
    <div class="flex min-h-screen bg-gray-50 text-gray-800">

        {{-- Sidebar --}}
        <aside class="w-64 bg-white shadow-lg flex flex-col justify-between">
            <div>
{{-- Navigasi --}}
<nav class="flex flex-col space-y-2 px-6">
    <!-- Home / AlPro -->
    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 text-blue-600 font-semibold">
        <!-- Ikon Home (Baru) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h5m4 0h5a1 1 0 001-1V10" />
        </svg>
        <span>AlPro</span>
    </a>

    <!-- Materi -->
    <a href="{{ route('materi.index') }}" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
        <!-- Ikon Document Text (ganti Book) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M7 8h10M7 12h6m2 8H7a2 2 0 01-2-2V6a2 2 0 012-2h7l4 4v12a2 2 0 01-2 2z" />
        </svg>
        <span>Materi</span>
    </a>

    <!-- Evaluasi -->
    <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
        <!-- Ikon Clock -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>Evaluasi</span>
    </a>

    <!-- Leaderboard -->
    <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
        <!-- Ikon Trophy -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M8 21h8m-4-4v4m5-10a5 5 0 01-10 0V4h10v7z" />
        </svg>
        <span>Leaderboard</span>
    </a>
</nav>

             
            </div>

           
        </aside>

        {{-- Konten Utama --}}
        <main class="flex-1 p-10 overflow-y-auto">

           {{-- Menu Card --}}
<div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-10">

    {{-- Materi Teks --}}
    <a href="{{ route('materi.teks') }}" 
       class="bg-gradient-to-br from-blue-100 to-pink-50 p-6 rounded-2xl shadow text-center block
              transform transition duration-300 hover:shadow-xl hover:-translate-y-1 active:scale-95">
        <img src="{{ asset('images/materi.svg') }}" class="w-16 mx-auto mb-4" alt="Materi">
        <h3 class="font-semibold text-gray-700">Materi Teks</h3>
    </a>

    {{-- Materi Video --}}
    <a href="{{ route('materi.video') }}" 
       class="bg-gradient-to-br from-purple-100 to-blue-50 p-6 rounded-2xl shadow text-center block
              transform transition duration-300 hover:shadow-xl hover:-translate-y-1 active:scale-95">
        <img src="{{ asset('images/video.svg') }}" class="w-16 mx-auto mb-4" alt="Video">
        <h3 class="font-semibold text-gray-700">Materi Video</h3>
    </a>

</div>


        </main>

    </div>
</x-app-layout>
