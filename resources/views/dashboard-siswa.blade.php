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
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
                <a href="{{ route('siswa.materi.index') }}" class="block">
                 <div class="bg-gradient-to-br from-blue-100 to-pink-50 p-6 rounded-2xl shadow hover:shadow-lg transition text-center cursor-pointer">
                  <img src="{{ asset('images/materi.svg') }}" 
                 class="w-16 mx-auto mb-4" 
                 alt="Materi">
                 <h3 class="font-semibold text-gray-700">Materi</h3>
                 </div>
            </a>

                <div class="bg-gradient-to-br from-purple-100 to-blue-50 p-6 rounded-2xl shadow hover:shadow-lg transition text-center">
                    <img src="{{ asset('images/leaderboard.svg') }}" class="w-16 mx-auto mb-4" alt="Leaderboard">
                    <h3 class="font-semibold text-gray-700">Leaderboard</h3>
                </div>
                <div class="bg-gradient-to-br from-pink-100 to-purple-50 p-6 rounded-2xl shadow hover:shadow-lg transition text-center">
                    <img src="{{ asset('images/evaluasi.svg') }}" class="w-16 mx-auto mb-4" alt="Evaluasi">
                    <h3 class="font-semibold text-gray-700">Evaluasi</h3>
                </div>
            </div>

            {{-- Lanjutkan Membaca --}}
<section class="mt-24 px-6"> {{-- mt-24 untuk memberi jarak dari navbar fixed --}}
    <h2 class="font-bold text-gray-800 mb-4">Lanjutkan Membaca</h2>
    <a href="{{ route('siswa.materi.teks') }}" class="block">
    <div class="bg-white rounded-xl shadow-md p-4 flex items-center space-x-6">
        <img src="{{ asset('images/code.jpg') }}" 
             class="w-32 h-20 rounded-lg object-cover" 
             alt="Preview">

        <div class="flex-1">
            <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-1 rounded">
                Materi
            </span>

            <h3 class="text-lg font-semibold text-gray-800 mt-2">
                Materi Algoritma dan Pemrograman
            </h3>

            {{-- Nama dan email pengguna yang login --}}
            @auth
                <p class="text-sm text-gray-500 mt-1">
                    {{ Auth::user()->name }} • {{ Auth::user()->email }}
                </p>
            @endauth

            {{-- Progress Bar --}}
            <div class="mt-3 bg-gray-200 rounded-full h-2">
                <div class="bg-blue-600 h-2 rounded-full w-1/3"></div>
            </div>
        </div>
    </div>
</a>
</section>

        </main>
    </div>
</div>
</x-app-layout>
