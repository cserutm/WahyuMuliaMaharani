<x-app-layout>
    {{-- Header slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Materi') }}
        </h2>
    </x-slot>

    {{-- Layout --}}
    <div class="flex min-h-screen bg-gray-50 text-gray-800">
        {{-- sidebar --}}
      @include('layouts.sidebar')


        {{-- Konten Utama --}}
        <main class="flex-1 p-10 overflow-y-auto">

           {{-- Menu Card --}}
<div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-10">

    {{-- Materi Teks --}}
    <a href="{{ route('siswa.materi.teks') }}" 
       class="bg-gradient-to-br from-blue-100 to-pink-50 p-6 rounded-2xl shadow text-center block
              transform transition duration-300 hover:shadow-xl hover:-translate-y-1 active:scale-95">
        <img src="{{ asset('images/materi.svg') }}" class="w-16 mx-auto mb-4" alt="Materi">
        <h3 class="font-semibold text-gray-700">Materi Teks</h3>
    </a>

    {{-- Materi Video --}}
    <a href="{{ route('siswa.materi.video') }}" 
       class="bg-gradient-to-br from-purple-100 to-blue-50 p-6 rounded-2xl shadow text-center block
              transform transition duration-300 hover:shadow-xl hover:-translate-y-1 active:scale-95">
        <img src="{{ asset('images/video.svg') }}" class="w-16 mx-auto mb-4" alt="Video">
        <h3 class="font-semibold text-gray-700">Materi Video</h3>
    </a>

</div>


        </main>

    </div>
</x-app-layout>
