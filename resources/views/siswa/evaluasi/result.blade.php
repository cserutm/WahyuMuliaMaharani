<x-app-layout>
    {{-- Header slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluasi') }}
        </h2>
    </x-slot>

    {{-- Layout --}}
    <div class="flex min-h-screen bg-gray-50 text-gray-800">

        {{-- sidebar --}}
      @include('layouts.sidebar')

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
        <a href="{{ route('siswa.evaluasi.index') }}"
           class="inline-block mt-6 px-4 py-1.5 text-sm bg-blue-500 text-white rounded-full hover:bg-blue-600 transition">
            Kembali
        </a>

    </div>
</main>

</div>
</x-app-layout>
