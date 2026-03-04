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
                    Pilih jenis materi yang ingin dikelola.
                </p>
            </div>

            {{-- Menu Card --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">

                {{-- Materi File --}}
                <a href="{{ route('guru.modul.index') }}"
                   class="group bg-white border border-gray-200 
                          rounded-2xl p-8 shadow-sm
                          hover:shadow-md hover:border-blue-200
                          transition-all duration-300">

                    <div class="flex items-center justify-between">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Materi File
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Upload dan kelola materi berbentuk dokumen.
                            </p>
                        </div>

                        <div class="bg-blue-50 text-blue-600 p-4 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.8" stroke="currentColor"
                                 class="w-6 h-6">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M7 8h10M7 12h6m2 8H7a2 2 0 01-2-2V6a2 2 0 012-2h7l4 4v12a2 2 0 01-2 2z"/>
                            </svg>
                        </div>

                    </div>
                </a>

                {{-- Materi Video --}}
                <a href="{{ route('guru.video.index') }}"
                   class="group bg-white border border-gray-200 
                          rounded-2xl p-8 shadow-sm
                          hover:shadow-md hover:border-blue-200
                          transition-all duration-300">

                    <div class="flex items-center justify-between">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Materi Video
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Tambahkan dan kelola video pembelajaran.
                            </p>
                        </div>

                        <div class="bg-blue-50 text-blue-600 p-4 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.8" stroke="currentColor"
                                 class="w-6 h-6">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 6h8a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z"/>
                            </svg>
                        </div>

                    </div>
                </a>

            </div>

        </main>

    </div>

</x-app-layout>