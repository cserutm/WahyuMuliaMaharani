<x-app-layout>
    {{-- Header slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Siswa') }}
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



        </main>
</div>


</x-app-layout>
