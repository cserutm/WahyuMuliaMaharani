<x-app-layout>

    <div class="flex">

        {{-- Sidebar --}}
        @include('guru.sidebar')

        {{-- Konten --}}
        <main class="flex-1 ml-64 p-10 space-y-10">

            <div class="max-w-4xl mx-auto space-y-8">

                {{-- Header Card --}}
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 
                            rounded-2xl p-6 shadow-sm">

                    <h1 class="text-2xl font-bold text-gray-800">
                        {{ $modul->judul }}
                    </h1>

                    <p class="text-sm text-gray-500 mt-2">
                        Dibuat: {{ $modul->created_at->format('d M Y H:i') }}
                    </p>
                </div>

                {{-- Detail Card --}}
                <div class="bg-white rounded-2xl shadow-lg p-8 space-y-8">

                    {{-- Tujuan --}}
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">
                            Tujuan Pembelajaran
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $modul->tujuan_pembelajaran }}
                        </p>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">
                            Deskripsi
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $modul->deskripsi }}
                        </p>
                    </div>

                    {{-- File --}}
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-4">
                            File Materi
                        </h3>

                        @if($modul->file_materi)
                        <div class="flex flex-wrap gap-3 mt-3">

                            {{-- Lihat Materi --}}
                            <a href="{{ asset('storage/' . $modul->file_materi) }}"
                               target="_blank"
                               class="inline-flex items-center gap-2
                                      bg-white border border-blue-600
                                      text-blue-600
                                      hover:bg-blue-600 hover:text-white
                                      text-sm font-medium
                                      px-4 py-2
                                      rounded-lg
                                      transition duration-200">
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
                                Lihat Materi
                            </a>

                            {{-- Download --}}
                            <a href="{{ route('guru.modul.download', $modul->id) }}"
                               class="inline-flex items-center gap-2
                                      bg-white border border-blue-600
                                      text-blue-600
                                      hover:bg-blue-600 hover:text-white
                                      text-sm font-medium
                                      px-4 py-2
                                      rounded-lg
                                      transition duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-4 h-4"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1
                                             M7 10l5 5m0 0l5-5m-5 5V4"/>
                                </svg>
                                Download
                            </a>

                        </div>
                        @else
                            <div class="bg-gray-50 rounded-xl p-4 text-gray-500">
                                Tidak ada file materi
                            </div>
                        @endif
                    </div>

                    {{-- Preview Video --}}
                    @if($modul->video_url)
                        @php
                            $video = $modul->video_url;
                            if(str_contains($video, 'youtu.be')){
                                $video = str_replace('youtu.be/','www.youtube.com/embed/',explode('?',$video)[0]);
                            } else {
                                $video = str_replace('watch?v=','embed/',$video);
                            }
                        @endphp

                        <div x-data="{ showVideo: false }" class="mt-6">
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
                                <span x-text="showVideo ? 'Sembunyikan Video' : 'Preview Video'"></span>
                            </button>

                            <div x-show="showVideo"
                                 x-transition
                                 class="mt-3 w-full aspect-video rounded-2xl overflow-hidden border shadow-sm">
                                <iframe class="w-full h-full"
                                        src="{{ $video }}"
                                        allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    @endif

                </div>

                {{-- Button Kembali --}}
                <div class="mt-10 flex justify-end">
                    <a href="{{ route('guru.modul.index') }}"
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
    </div>

</x-app-layout>