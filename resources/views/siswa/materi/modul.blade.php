<x-app-layout>

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Konten Utama --}}
    <main class="ml-64 pt-16 px-10 pb-16 min-h-screen bg-gray-100">

        <div class="max-w-6xl mx-auto">

            <div class="grid gap-8 [grid-template-columns:repeat(auto-fit,minmax(280px,1fr))]">

                @forelse($moduls as $modul)

                    <div class="bg-white border border-gray-200 
                                rounded-2xl p-6 shadow-sm
                                hover:shadow-md hover:border-blue-200
                                transition-all duration-300">

                        {{-- Header --}}
                        <div class="flex items-start gap-4 mb-4">

                            <div class="bg-blue-50 text-blue-600 p-3 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.8" stroke="currentColor"
                                     class="w-6 h-6">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 6v12m6-6H6"/>
                                </svg>
                            </div>

                            <div>
                                <h3 class="font-semibold text-gray-800">
                                    {{ $modul->judul }}
                                </h3>
                                <p class="text-sm text-gray-400 mt-1">
                                    Materi Pembelajaran
                                </p>
                            </div>

                        </div>

                        {{-- Lihat & Download --}}
                        <div class="flex flex-wrap gap-3">

                            @if($modul->file_materi)
                                <a href="{{ asset('storage/' . $modul->file_materi) }}"
                                   target="_blank"
                                   class="inline-flex items-center gap-2
                                          px-4 py-2 text-sm
                                          bg-white border border-gray-300
                                          text-gray-600 rounded-full
                                          hover:bg-gray-50 hover:border-gray-400
                                          transition">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.8" stroke="currentColor"
                                         class="w-4 h-4">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M15 12H9m6 0l-3-3m3 3l-3 3"/>
                                    </svg>
                                    Lihat
                                </a>

                                <a href="{{ route('siswa.modul.download', $modul->id) }}"
                                   class="inline-flex items-center gap-2
                                          px-5 py-2 text-sm
                                          bg-blue-600 text-white
                                          rounded-full
                                          hover:bg-blue-700
                                          transition">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.8" stroke="currentColor"
                                         class="w-4 h-4">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 4v12m0 0l-3-3m3 3l3-3"/>
                                    </svg>
                                    Download
                                </a>
                            @else
                                <p class="text-sm text-gray-400 mt-2">
                                    File belum tersedia.
                                </p>
                            @endif

                        </div>

                        {{-- Preview Video --}}
                        @if($modul->video_url)
                            @php
                                $video = $modul->video_url;
                                if(str_contains($video,'youtu.be')){
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
                                      d="M3 7h18M3 12h18M3 17h18"/>
                            </svg>
                        </div>

                        <h3 class="text-lg font-semibold text-gray-800">
                            Belum Ada Materi
                        </h3>

                        <p class="text-gray-500 mt-2">
                            Materi akan muncul setelah guru mengunggahnya.
                        </p>
                    </div>
                @endforelse

            </div>

            {{-- Button Kembali --}}
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