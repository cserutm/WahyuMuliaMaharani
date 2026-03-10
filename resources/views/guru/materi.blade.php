<x-app-layout>

<div class="flex">

    {{-- Sidebar --}}
    @include('guru.sidebar')

    {{-- Konten --}}
    <main class="flex-1 ml-64 p-10 space-y-10">

        {{-- Judul Halaman --}}
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">
                Kelola Materi
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Daftar materi pembelajaran yang tersedia.
            </p>
        </div>


        {{-- LIST CARD MATERI --}}
        <div class="space-y-6">

            @forelse ($modul as $item)

            <a href="{{ route('guru.modul.index',$item->id) }}"
               class="block group bg-white border border-gray-200 
                      rounded-2xl p-8 shadow-sm
                      hover:shadow-md hover:border-blue-200
                      transition-all duration-300">

                <div class="flex items-start justify-between">

                    <div>

                        <h3 class="text-lg font-semibold text-gray-800">
                            Materi {{ $loop->iteration }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ $item->judul }}
                        </p>


                        {{-- FILE + VIDEO --}}
                        <div class="flex items-center gap-6 mt-4">

                            {{-- FILE PDF --}}
                            @if($item->file_materi)
                            <span class="flex items-center gap-2 text-gray-500 text-sm">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke-width="1.8"
                                     stroke="currentColor"
                                     class="w-5 h-5">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M7 7h10M7 11h6m-9 9h12a2 2 0 002-2V8l-4-4H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>

                                </svg>

                                File Materi
                            </span>
                            @endif


                            {{-- VIDEO --}}
                            @if($item->video_url)
                            <span class="flex items-center gap-2 text-gray-500 text-sm">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke-width="1.8"
                                     stroke="currentColor"
                                     class="w-5 h-5">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14m-6 4h6a2 2 0 002-2V8a2 2 0 00-2-2H9a2 2 0 00-2 2v8a2 2 0 002 2z"/>

                                </svg>

                                Video Pembelajaran
                            </span>
                            @endif

                        </div>

                    </div>


                    {{-- ICON CARD --}}
                    <div class="bg-blue-50 text-blue-600 p-4 rounded-xl">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.8"
                             stroke="currentColor"
                             class="w-6 h-6">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M7 8h10M7 12h6m2 8H7a2 2 0 01-2-2V6a2 2 0 012-2h7l4 4v12a2 2 0 01-2 2z"/>

                        </svg>

                    </div>

                </div>

            </a>

            @empty

            <div class="text-center text-gray-400 py-20">
                Belum ada materi tersedia
            </div>

            @endforelse

        </div>

    </main>

</div>

</x-app-layout>