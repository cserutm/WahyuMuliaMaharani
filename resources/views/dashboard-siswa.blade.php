<x-app-layout>


    {{-- Sidebar --}}
    @include('layouts.sidebar')


    {{-- Konten Utama --}}
    <main class="ml-64 pt-16 px-10 pb-16 min-h-screen bg-gray-50">

    <div class="max-w-7xl mx-auto space-y-10">

        {{-- Banner --}}
        <div class="bg-white border border-gray-200 
                    rounded-2xl p-8 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <div class="bg-gray-100 inline-block px-4 py-1 
                                rounded-full text-xs font-semibold 
                                text-gray-600 mb-4">
                        Media Pembelajaran
                    </div>

                    <h1 class="text-2xl font-semibold text-gray-800">
                        Algoritma dan Pemrograman
                    </h1>

                    <p class="text-gray-600 mt-2">
                        Akses materi dan evaluasi untuk meningkatkan pemahamanmu.
                    </p>
                </div>

                {{-- Icon Education --}}
                <div class="hidden sm:flex items-center justify-center 
                            w-16 h-16 bg-blue-50 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="w-8 h-8 text-blue-600"
                         fill="none" viewBox="0 0 24 24" 
                         stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 14l6.16-3.422A12.083 12.083 0 0112 20.055
                                 a12.083 12.083 0 01-6.16-9.477L12 14z"/>
                    </svg>
                </div>

            </div>

        </div>

        {{-- Menu Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

            {{-- Materi --}}
            <a href="{{ route('siswa.materi.index') }}">
                <div class="bg-white border border-gray-200
                            rounded-2xl p-6
                            shadow-sm hover:shadow-md
                            transition duration-300">

                    <div class="flex items-center justify-between">

                        <div>
                            <h3 class="font-semibold text-gray-800 text-lg">
                                Materi
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $totalMateri ?? 0 }} Materi tersedia
                            </p>
                        </div>

                        <div class="w-12 h-12 bg-gray-100 
                                    rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 class="w-6 h-6 text-blue-600"
                                 fill="none" viewBox="0 0 24 24" 
                                 stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M7 8h10M7 12h6m2 8H7a2 2 0 01-2-2V6a2 2 0 012-2h7l4 4v12a2 2 0 01-2 2z"/>
                            </svg>
                        </div>

                    </div>
                </div>
            </a>

            {{-- Evaluasi --}}
            <a href="{{ route('siswa.evaluasi.index') }}">
                <div class="bg-white border border-gray-200
                            rounded-2xl p-6
                            shadow-sm hover:shadow-md
                            transition duration-300">

                    <div class="flex items-center justify-between">

                        <div>
                            <h3 class="font-semibold text-gray-800 text-lg">
                                Evaluasi
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $totalKuis ?? 0 }} Kuis tersedia
                            </p>
                        </div>

                        <div class="w-12 h-12 bg-gray-100 
                                    rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 class="w-6 h-6 text-blue-600"
                                 fill="none" viewBox="0 0 24 24" 
                                 stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5
                                         a2 2 0 012-2h5l5 5v11a2 2 0 01-2 2z"/>
                            </svg>
                        </div>

                    </div>
                </div>
            </a>

            {{-- Leaderboard --}}
            <a href="{{ route('siswa.leaderboard') }}">
                <div class="bg-white border border-gray-200
                            rounded-2xl p-6
                            shadow-sm hover:shadow-md
                            transition duration-300">

                    <div class="flex items-center justify-between">

                        <div>
                            <h3 class="font-semibold text-gray-800 text-lg">
                                Leaderboard
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Lihat peringkat siswa
                            </p>
                        </div>

                        <div class="w-12 h-12 bg-gray-100 
                                    rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 class="w-6 h-6 text-blue-600"
                                 fill="none" viewBox="0 0 24 24" 
                                 stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M8 21h8m-4-4v4m5-10a5 5 0 01-10 0V4h10v7z"/>
                            </svg>
                        </div>

                    </div>
                </div>
            </a>

        </div>

    </div>

</main>
</x-app-layout>