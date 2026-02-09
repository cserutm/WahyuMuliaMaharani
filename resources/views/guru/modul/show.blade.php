<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Materi') }}
        </h2>
    </x-slot>

    {{-- Layout Utama --}}
    <div class="flex min-h-screen bg-gray-50 text-gray-800">

        {{-- Sidebar --}}
        @include('guru.sidebar')

        {{-- Konten --}}
        <main class="flex-1 p-10 overflow-y-auto">
             <div class="max-w-3xl mx-auto">

                {{-- Card --}}
                <div class="bg-white rounded-2xl shadow p-8 space-y-6">

                    {{-- Judul --}}
                    <div>
                        <h1 class="text-2xl font-bold text-gray-600">
                            {{ $modul->judul }}
                        </h1>
                        <p class="text-sm text-gray-500 mt-1">
                            Dibuat: {{ $modul->created_at->format('d M Y H:i') }}
                        </p>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-1">Deskripsi</h3>
                        <p class="text-gray-600">
                            {{ $modul->deskripsi }}
                        </p>
                    </div>

                    {{-- Tujuan --}}
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-1">Tujuan Pembelajaran</h3>
                        <p class="text-gray-600">
                            {{ $modul->tujuan_pembelajaran }}
                        </p>
                    </div>

                    {{-- File --}}
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">File Materi</h3>

                        @if($modul->file_materi)

                            <div class="flex items-center gap-4">

                                {{-- Preview --}}
                                <a href="{{ asset('storage/' . $modul->file_materi) }}"
                                   target="_blank"
                                 
                                      class="flex items-center gap-1 text-green-600 hover:text-green-800">
                                  <svg xmlns="http://www.w3.org/2000/svg"
         class="w-4 h-4 sm:w-5 sm:h-5"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M2.458 12C3.732 7.943 7.523 5 12 5
                 c4.477 0 8.268 2.943 9.542 7
                 -1.274 4.057-5.065 7-9.542 7
                 -4.477 0-8.268-2.943-9.542-7z" />
    </svg>
     <span class="hidden sm:inline">Lihat Materi</span>
                                </a>

                                {{-- Download --}}
                                <a href="{{ route('guru.modul.download', $modul->id) }}"
                                   class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                   <svg xmlns="http://www.w3.org/2000/svg"
         class="w-4 h-4"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M7 10l5 5m0 0l5-5m-5 5V4" />
    </svg>
                                 
                                </a>

                            </div>

                        @else
                            <p class="text-gray-500">Tidak ada file</p>
                        @endif
                    </div>

                </div>

                {{-- Tombol Kembali --}}
                <div class="mt-6">
                    <a href="{{ route('guru.modul.index') }}"
                       class="text-blue-500 hover:underline">
                        ← Kembali 
                    </a>
                </div>

            </div>
</main>
</div>
</x-app-layout>

