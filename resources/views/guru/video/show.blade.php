<x-app-layout>

    <div class="flex">

        {{-- Sidebar --}}
        @include('guru.sidebar')

        {{-- Konten --}}
        <main class="flex-1 ml-64 p-10 space-y-10">

            <div class="max-w-4xl mx-auto space-y-8">
                @php $video = $videos; @endphp

                {{-- Card --}}
                <div class="bg-white rounded-2xl shadow-lg p-8 space-y-8">

                    {{-- Header --}}
                    <div class="border-b pb-4">
                        <h1 class="text-2xl font-bold text-gray-800">
                            {{ $video->judul }}
                        </h1>
                        <p class="text-sm text-gray-500 mt-1">
                            Dibuat: {{ $video->created_at->format('d M Y H:i') }}
                        </p>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <h3 class="text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wide">
                            Deskripsi
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $video->deskripsi }}
                        </p>
                    </div>

                    {{-- Tujuan --}}
                    <div>
                        <h3 class="text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wide">
                            Tujuan Pembelajaran
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $video->tujuan_pembelajaran }}
                        </p>
                    </div>

                    {{-- Preview Video --}}
                    <div x-data="{ showVideo: false }" class="space-y-4">

                        {{-- Button Preview --}}
                        <button
                            @click="showVideo = !showVideo"
                            class="inline-flex items-center gap-2
                                   px-4 py-2
                                   bg-blue-100 text-blue-600
                                   rounded-xl
                                   hover:bg-blue-200
                                   transition shadow-sm">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-4 h-4"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5
                                         c4.477 0 8.268 2.943 9.542 7
                                         -1.274 4.057-5.065 7-9.542 7
                                         -4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>

                            <span x-text="showVideo ? 'Sembunyikan' : 'Preview'"></span>
                        </button>

                        {{-- Video Embed --}}
                        <div
                            x-show="showVideo"
                            x-transition
                            class="w-full aspect-video rounded-2xl overflow-hidden shadow-md border">

                            <iframe
                                class="w-full h-full"
                                src="{{ 
                                    str_contains($video->video_url, 'youtu.be')
                                        ? str_replace('youtu.be/', 'www.youtube.com/embed/', explode('?', $video->video_url)[0])
                                        : str_replace('watch?v=', 'embed/', $video->video_url)
                                }}"
                                allowfullscreen>
                            </iframe>

                        </div>
                    </div>

                    {{-- Tombol Kembali --}}
                    <div class="pt-6 border-t flex justify-end">
                        <a href="{{ route('guru.video.index') }}"
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
            </div>

        </main>
    </div>

</x-app-layout>