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
        <main class="flex-1 p-10 overflow-y-auto flex justify-center items-start">

    @php
        $color = $score >= 80 ? 'blue' : ($score >= 70 ? 'green' : ($score >= 50 ? 'yellow' : 'red'));

        if($score >= 80){
            $badge = "Excellent ⭐";
            $message = "Luar biasa! Kamu sangat menguasai materi!";
        } elseif($score >= 70){
            $badge = "Good 👍";
            $message = "Bagus! Pertahankan semangat belajarmu!";
        } elseif($score >= 50){
            $badge = "Keep Trying 💪";
            $message = "Lumayan! Tingkatkan lagi ya!";
        } else {
            $badge = "Don't Give Up 🔥";
            $message = "Jangan menyerah, pelajari materi lagi!";
        }
    @endphp

    <div class="bg-white rounded-3xl shadow-xl p-10 w-full max-w-lg text-center">

        {{-- Lingkaran Nilai --}}
        <div class="flex justify-center mb-6">
            <div class="w-48 h-48 rounded-full border-8 flex flex-col items-center justify-center text-white border-blue-200 bg-blue-500">
        <p class="text-sm">Nilai Kamu</p>

        <h2 class="text-4xl font-bold">
            {{ $score ?? 0 }}/100
        </h2>
    </div>
</div>


        {{-- Ringkasan --}}
        <div class="bg-gray-50 border rounded-xl p-4 mb-5 text-sm">
            <p class="text-gray-700 font-semibold mb-2 text-center">Ringkasan Hasil</p>
            <div class="space-y-1 text-gray-700 text-center">
                <p>Jawaban Benar: <span class="font-semibold">{{ $correct }}</span></p>
                <p>Total Soal: <span class="font-semibold">{{ $total }}</span></p>
            </div>
        </div>

        {{-- Badge & Pesan --}}
        <h3 class="text-xl font-semibold
            {{ $color == 'blue' ? 'text-blue-600' : '' }}
            {{ $color == 'green' ? 'text-green-600' : '' }}
            {{ $color == 'yellow' ? 'text-yellow-600' : '' }}
            {{ $color == 'red' ? 'text-red-600' : '' }}">
            {{ $badge }}
        </h3>
        <p class="text-gray-600 mt-2">{{ $message }}</p>

        {{-- Tombol --}}
        <a href="{{ route('evaluasi.index') }}"
           class="inline-block mt-6 px-4 py-1.5 text-sm bg-blue-500 text-white rounded-full hover:bg-blue-600 transition">
            Kembali
        </a>

    </div>
</main>

</div>
</x-app-layout>
