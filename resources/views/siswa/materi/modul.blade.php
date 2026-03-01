<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Materi File</h2>
    </x-slot>

    <div class="flex min-h-screen bg-gray-50">
        @include('layouts.sidebar')

        <main class="flex-1 p-10">
           <div class="grid gap-6 
            [grid-template-columns:repeat(auto-fit,minmax(300px,1fr))]">

@forelse($moduls as $modul)

    <div class="bg-white rounded-2xl shadow p-6" hover:shadow-lg transition  >
        <h3 class="font-semibold text-gray-700 mb-2">
            {{ $modul->judul }}
        </h3>

        @if($modul->file_materi)

            <div class="flex items-center gap-4">

                {{-- Preview --}}
                <a href="{{ asset('storage/' . $modul->file_materi) }}"
                   target="_blank"
                   class="text-green-600 hover:text-green-800">
                    Lihat Materi
                </a>

                {{-- Download --}}
                <a href="{{ route('siswa.modul.download', $modul->id) }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                    Download
                </a>

            </div>

        @else
            <p class="text-gray-500">Tidak ada file</p>
        @endif

    </div>

@empty
    <p>Tidak ada materi tersedia.</p>
@endforelse

</div>

        </main>
    </div>
</x-app-layout>