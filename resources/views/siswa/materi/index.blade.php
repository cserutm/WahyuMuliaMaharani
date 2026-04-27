<x-app-layout>

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Konten Utama --}}
    <main class="ml-64 pt-16 px-10 pb-16 min-h-screen bg-gray-100">

        <div class="max-w-5xl mx-auto">

            {{-- HEADER --}}
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">
                    Materi Pembelajaran
                </h1>
                <p class="text-gray-500 text-sm mt-1">
                    Akses semua materi yang diberikan oleh guru
                </p>
            </div>

            {{-- CARD BESAR --}}
            <a href="{{ route('siswa.materi.modul') }}"
                class="group block bg-white border border-gray-200
                  rounded-3xl p-10 shadow-sm
                  hover:shadow-xl hover:border-blue-300
                  transition-all duration-300">

                <div class="flex items-center justify-between">

                    <div class="flex items-center gap-6">

                        {{-- ICON --}}
                        <div class="bg-blue-50 text-blue-600 p-5 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-8 h-8"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 6v12m6-6H6" />
                            </svg>
                        </div>

                        {{-- TEXT --}}
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">
                                Materi Pembelajaran Algoritma dan Pemrograman
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Lihat semua materi file & video yang telah diberikan guru
                            </p>
                        </div>

                    </div>

                    {{-- ARROW --}}
                    <div class="text-gray-400 group-hover:text-blue-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-7 h-7"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7" />
                        </svg>
                    </div>

                </div>

            </a>

        </div>

    </main>

</x-app-layout>