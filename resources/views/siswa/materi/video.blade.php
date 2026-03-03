<x-app-layout>
   
    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Konten Utama --}}
    
      <main class="ml-64 pt-16 px-10 pb-16 min-h-screen bg-gray-100">

    <div class="max-w-6xl mx-auto">

        <div class="grid gap-8 
            [grid-template-columns:repeat(auto-fit,minmax(320px,1fr))]">

            @forelse($videos as $video)

                <div class="bg-white border border-gray-200 
                            rounded-2xl p-6 shadow-sm
                            hover:shadow-md hover:border-blue-200
                            transition-all duration-300">

                    {{-- Header --}}
                    <div class="flex items-start gap-4 mb-4">

                        {{-- Icon --}}
                        <div class="bg-blue-50 text-blue-600 p-3 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.8" stroke="currentColor"
                                 class="w-6 h-6">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 6h8a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z"/>
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-800">
                                {{ $video->judul }}
                            </h3>
                            <p class="text-sm text-gray-400 mt-1">
                                Video Pembelajaran
                            </p>
                        </div>

                    </div>

                    {{-- Deskripsi --}}
                    <p class="text-sm text-gray-600 mb-5">
                        {{ $video->deskripsi }}
                    </p>

                    {{-- Embed Processing --}}
                    @php
                        $videoUrl = $video->video_url ?? '';

                        if (str_contains($videoUrl, 'watch?v=')) {
                            $videoUrl = str_replace('watch?v=', 'embed/', $videoUrl);
                        } elseif (str_contains($videoUrl, 'youtu.be/')) {
                            $videoId = substr($videoUrl, strrpos($videoUrl, '/') + 1);
                            $videoUrl = 'https://www.youtube.com/embed/' . $videoId;
                        }
                    @endphp

                    {{-- Video --}}
                    @if($videoUrl)
                        <div class="aspect-video max-w-xl mx-auto rounded-xl overflow-hidden border border-gray-200">
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

                {{-- Empty State --}}
                <div class="col-span-full bg-white border border-gray-200
                            rounded-2xl p-12 text-center shadow-sm">

                    <div class="mx-auto w-16 h-16 bg-blue-50 text-blue-600
                                rounded-2xl flex items-center justify-center mb-5">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24"
                             stroke-width="1.8" stroke="currentColor"
                             class="w-8 h-8">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 6h8a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z"/>
                        </svg>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800">
                        Belum Ada Video
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Video pembelajaran akan tersedia setelah guru mengunggahnya.
                    </p>
                </div>

            @endforelse

        </div>

        {{-- Button Kembali (Clean Style) --}}
        <div class="mt-10 flex justify-end">
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center gap-2
                      px-5 py-2.5 text-sm
                      bg-white border border-gray-300
                      text-gray-600
                      rounded-full
                      hover:bg-gray-50 hover:border-gray-400
                      transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     class="w-4 h-4">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M15 18l-6-6 6-6"/>
                </svg>

                <span>Kembali</span>
            </a>
        </div>

    </div>

</main>
    
</x-app-layout>