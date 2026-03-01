<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Materi File</h2>
    </x-slot>

    <div class="flex min-h-screen bg-gray-50">
        @include('layouts.sidebar')

        <main class="flex-1 p-10">
           <div class="grid gap-6 
            [grid-template-columns:repeat(auto-fit,minmax(300px,1fr))]">

@forelse($videos as $video)

    <div class="bg-white rounded-2xl shadow p-6" hover:shadow-lg transition  >
        <h3 class="font-semibold text-gray-700 mb-2">
            {{ $video->judul }}
        </h3>

         {{-- Deskripsi Video --}}
            <p class="mt-4 text-gray-600">
                 {{ $video->deskripsi }}
</p>

             {{-- VIDEO EMBED --}}
                        @php
                            $videoUrl = $video->video_url ?? '';

                            if (str_contains($videoUrl, 'watch?v=')) {
                                $videoUrl = str_replace('watch?v=', 'embed/', $videoUrl);
                            } elseif (str_contains($videoUrl, 'youtu.be/')) {
                                $videoId = substr($videoUrl, strrpos($videoUrl, '/') + 1);
                                $videoUrl = 'https://www.youtube.com/embed/' . $videoId;
                            }
                        @endphp

                        @if($videoUrl)
                            <div class="w-full aspect-video rounded-xl overflow-hidden shadow">
                                <iframe 
                                    class="w-full h-full"
                                    src="{{ $videoUrl }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        @endif
     

    </div>

@empty
    <p>Tidak ada materi tersedia.</p>
@endforelse

</div>

        </main>
    </div>
</x-app-layout>