<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Materi Teks
        </h2>
    </x-slot>

    {{-- Layout --}}
    <div class="flex min-h-screen bg-gray-50 text-gray-800">
        {{-- sidebar --}}
      @include('layouts.sidebar')

    <main class="p-10">

        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-md p-8">

            <h1 class="text-2xl font-bold mb-4">
                <h1>{{ $materi?->judul ?? 'Algoritma dan Pemrograman' }}</h1>

            </h1>

            {{-- Gambar Materi --}}
            @if($materi && $materi->gambar)
                <img src="{{ asset('storage/'.$materi->gambar) }}" 
                     class="w-full rounded-xl mb-6">
            @endif

            {{-- Konten Materi --}}
            <p class="text-gray-700 leading-relaxed text-justify">
                {{ $materi->konten ?? 'Isi materi algoritma dan pemrograman...' }}
            </p>

        </div>

    </main>
</x-app-layout>
