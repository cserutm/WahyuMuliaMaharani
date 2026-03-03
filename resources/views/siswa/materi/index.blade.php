<x-app-layout>

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Konten Utama --}}
    <main class="ml-64 pt-16 px-10 pb-16 min-h-screen bg-gray-100">

    <div class="max-w-6xl mx-auto">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">

            {{-- Card Modul --}}
            <a href="{{ route('siswa.materi.modul') }}"
               class="group bg-white border border-gray-200
                      rounded-2xl p-8 shadow-sm
                      hover:shadow-md hover:border-blue-200
                      transition-all duration-300">

                <div class="flex items-center gap-5">

                    {{-- Icon --}}
                    <div class="bg-blue-50 text-blue-600 p-4 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24"
                             stroke-width="1.8" stroke="currentColor"
                             class="w-7 h-7">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 6v12m6-6H6"/>
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            Materi Modul
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Akses file pembelajaran dan materi tertulis.
                        </p>
                    </div>

                </div>

            </a>

            {{-- Card Video --}}
            <a href="{{ route('siswa.materi.video') }}"
               class="group bg-white border border-gray-200
                      rounded-2xl p-8 shadow-sm
                      hover:shadow-md hover:border-blue-200
                      transition-all duration-300">

                <div class="flex items-center gap-5">

                    {{-- Icon --}}
                    <div class="bg-blue-50 text-blue-600 p-4 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24"
                             stroke-width="1.8" stroke="currentColor"
                             class="w-7 h-7">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 6h8a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z"/>
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            Materi Video
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Tonton video pembelajaran interaktif.
                        </p>
                    </div>

                </div>

            </a>

        </div>

    </div>

</main>

</x-app-layout>