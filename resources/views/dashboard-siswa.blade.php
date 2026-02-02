<x-app-layout>
    {{-- Header slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- Layout --}}
    <div class="flex min-h-screen bg-gray-50 text-gray-800">
     {{-- sidebar --}}
      @include('layouts.sidebar')

        {{-- Konten Utama --}}
        <main class="flex-1 p-10 overflow-y-auto">
            {{-- Banner --}}
            <a href="{{ route('siswa.materi.video') }}" class="block">
            <div class="bg-blue-100 rounded-2xl p-6 flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Selamat Datang di Media Pembelajaran
                    </h1>
                    <p class="text-blue-800 text-lg font-semibold">
                        Algoritma dan Pemrograman
                    </p>
                    <button class="mt-4 flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full shadow">
                        <i class="fa-solid fa-play"></i>
                        <span>Lihat Video</span>
                    </button>
                </div>
                <img src="{{ asset('images/banner.svg') }}" class="w-64" alt="Banner">
            </div>
</a>

           {{-- Menu Card --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10 items-stretch">

    <a href="{{ route('siswa.materi.index') }}" class="h-full">
        <div class="h-full bg-gradient-to-br from-blue-100 to-pink-50 p-6 rounded-2xl shadow hover:shadow-lg transition text-center flex flex-col justify-center">
            <img src="{{ asset('images/materi.svg') }}" class="w-16 h-16 mx-auto mb-4" alt="Materi">
            <h3 class="font-semibold text-gray-700">Materi</h3>
        </div>
    </a>

    <a href="{{ route('leaderboard') }}" class="h-full">
        <div class="h-full bg-gradient-to-br from-purple-100 to-blue-50 p-6 rounded-2xl shadow hover:shadow-lg transition text-center flex flex-col justify-center">
            <img src="{{ asset('images/leaderboard.svg') }}" class="w-16 h-16 mx-auto mb-4" alt="Leaderboard">
            <h3 class="font-semibold text-gray-700">Leaderboard</h3>
        </div>
    </a>

    <a href="{{ route('siswa.evaluasi.index') }}" class="h-full">
        <div class="h-full bg-gradient-to-br from-pink-100 to-purple-50 p-6 rounded-2xl shadow hover:shadow-lg transition text-center flex flex-col justify-center">
            <img src="{{ asset('images/evaluasi.svg') }}" class="w-16 h-16 mx-auto mb-4" alt="Evaluasi">
            <h3 class="font-semibold text-gray-700">Evaluasi</h3>
        </div>
    </a>

</div>


           {{-- Lanjutkan Membaca --}}
<section class="mt-24 px-4 sm:px-6">
    <h2 class="font-bold text-gray-800 mb-4">Lanjutkan Membaca</h2>

    <a href="{{ route('siswa.materi.teks') }}" class="block">
        <div class="bg-white rounded-xl shadow-md p-4
                    flex flex-col sm:flex-row
                    sm:items-center
                    gap-4 sm:gap-6">

            {{-- Gambar --}}
            <img src="{{ asset('images/code.jpg') }}"
                 class="w-full sm:w-32 h-40 sm:h-20
                        rounded-lg object-cover"
                 alt="Preview">

            {{-- Konten --}}
            <div class="flex-1">
                <span class="inline-block bg-blue-100 text-blue-700
                             text-xs font-semibold px-2 py-1 rounded">
                    Materi
                </span>

                <h3 class="text-base sm:text-lg font-semibold text-gray-800 mt-2">
                    Materi Algoritma dan Pemrograman
                </h3>

                @auth
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">
                        {{ Auth::user()->name }} • {{ Auth::user()->email }}
                    </p>
                @endauth

                {{-- Progress Bar --}}
               <div class="mt-3 w-full bg-gray-200 rounded-full h-2">
                <div id="progressBar" class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: 0%">
                 </div>
                </div>

        </div>
    </a>
</section>
        </main>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const bar = document.getElementById('progressBar');
    if (!bar) return;

    const progress = localStorage.getItem('materi_progress') ?? 0;
    bar.style.width = progress + '%';
});
</script>


</x-app-layout>
