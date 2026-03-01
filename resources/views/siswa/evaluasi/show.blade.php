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
        <main class="flex-1 p-10 overflow-y-auto">
       <h2 class="text-xl font-bold mb-4">
    Kuis: {{ $kuis->judul }}
</h2>

<form action="{{ route('siswa.evaluasi.submit', $kuis->id) }}" method="POST">
@csrf

@foreach($kuis->pertanyaan as $q)
<div class="mb-4 p-4 bg-white rounded shadow">
    <p class="font-semibold">{{ $q->soal }}</p>

    <label><input type="radio" name="jawaban[{{ $q->id }}]" value="a"> {{ $q->opsi_a }}</label><br>
    <label><input type="radio" name="jawaban[{{ $q->id }}]" value="b"> {{ $q->opsi_b }}</label><br>
    <label><input type="radio" name="jawaban[{{ $q->id }}]" value="c"> {{ $q->opsi_c }}</label><br>
    <label><input type="radio" name="jawaban[{{ $q->id }}]" value="d"> {{ $q->opsi_d }}</label>
</div>
@endforeach

<button class="px-4 py-2 bg-blue-500 text-white rounded">
    Submit Jawaban
</button>
</form>

</main>

    </div>
</x-app-layout>
