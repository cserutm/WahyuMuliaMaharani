<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Materi Video
        </h2>
    </x-slot>
    {{-- Layout --}}
    <div class="flex min-h-screen bg-gray-50 text-gray-800">
        {{-- sidebar --}}
      @include('layouts.sidebar')

    <main class="p-10">

        <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-md p-8">

            <h1 class="text-2xl font-bold mb-4">
    <h1>{{ $materi?->judul ?? 'Algoritma dan Pemrograman' }}</h1>



            {{-- Video --}}
            <div class="w-full aspect-video rounded-xl overflow-hidden shadow-lg">
                <iframe 
                    class="w-full h-full"
                    src="{{ str_replace('watch?v=', 'embed/', $materi->video_url ?? '') }}"
                    frameborder="0"
                    allowfullscreen>
                </iframe>
            </div>

            {{-- Deskripsi Video --}}
            <p class="mt-4 text-gray-600">
                {{ $materi->deskripsi ?? 'Video pembelajaran algoritma dan pemrograman.' }}
            </p>

        </div>

    </main>
</x-app-layout>
