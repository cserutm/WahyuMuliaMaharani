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
       <h2 class="text-xl font-bold mb-4">
    Kuis: {{ $quiz->judul }}
</h2>

<form action="{{ route('evaluasi.submit', $quiz->id) }}" method="POST">
@csrf

@foreach($quiz->questions as $q)
<div class="mb-4 p-4 bg-white rounded shadow">
    <p class="font-semibold">{{ $q->soal }}</p>

    <label><input type="radio" name="jawaban[{{ $q->id }}]" value="A"> {{ $q->opsi_a }}</label><br>
    <label><input type="radio" name="jawaban[{{ $q->id }}]" value="B"> {{ $q->opsi_b }}</label><br>
    <label><input type="radio" name="jawaban[{{ $q->id }}]" value="C"> {{ $q->opsi_c }}</label><br>
    <label><input type="radio" name="jawaban[{{ $q->id }}]" value="D"> {{ $q->opsi_d }}</label>
</div>
@endforeach

<button class="px-4 py-2 bg-blue-500 text-white rounded">
    Submit Jawaban
</button>
</form>

</main>

    </div>
</x-app-layout>
