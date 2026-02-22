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

               @php $video = $videos; @endphp
                {{-- Card --}}
                <div class="bg-white rounded-2xl shadow p-8 space-y-6">


                    {{-- Judul --}}
                    <div>
                        <h1 class="text-2xl font-bold text-gray-600">
                            {{ $video->judul }}
                        </h1>
                        <p class="text-sm text-gray-500 mt-1">
                            Dibuat: {{ $video->created_at->format('d M Y H:i') }}
                        </p>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-1">Deskripsi</h3>
                        <p class="text-gray-600">
                            {{ $video->deskripsi }}
                        </p>
                    </div>

                    {{-- Tujuan --}}
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-1">Tujuan Pembelajaran</h3>
                        <p class="text-gray-600">
                            {{ $video->tujuan_pembelajaran }}
                        </p>
                    </div>

       
                    {{-- Preview Video --}}
<div x-data="{ showVideo: false }" class="space-y-4">

    {{-- Button --}}
    <button
        @click="showVideo = !showVideo"
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
     <span class="hidden sm:inline">preview</span>
       
    </button>

    {{-- Video --}}
    <div 
        x-show="showVideo"
        x-transition
        class="w-full aspect-video rounded-xl overflow-hidden shadow-lg">

        <iframe 
            class="w-full h-full"
            src="{{ 
    str_contains($video->video_url, 'youtu.be')
        ? str_replace('youtu.be/', 'www.youtube.com/embed/', explode('?', $video->video_url)[0])
        : str_replace('watch?v=', 'embed/', $video->video_url)
}}">

        </iframe>

    </div>
</div>

                   
                

                {{-- Tombol Kembali --}}
                <div class="mt-6">
                    <a href="{{ route('guru.video.index') }}"
                       class="text-blue-500 hover:underline">
                        ← Kembali 
                    </a>
                </div>
             

            </div>
</main>
</div>
</x-app-layout>

