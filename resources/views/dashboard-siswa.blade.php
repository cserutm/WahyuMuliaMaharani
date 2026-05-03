<x-app-layout>
    <div class="flex">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Konten Utama --}}
        <main class="flex-1 ml-0 lg:ml-64 p-4 sm:p-6 lg:p-8 space-y-8">

            <div class="max-w-7xl mx-auto space-y-8">

                {{-- HERO HEADER --}}
                <section class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-800 p-6 sm:p-8 lg:p-10 text-white shadow-2xl">

                    <div class="absolute top-0 right-0 w-72 h-72 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-400/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>

                    <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                        <div>
                            <p class="uppercase tracking-[3px] text-blue-200 text-xs font-semibold mb-3">
                                Media Pembelajaran Interaktif
                            </p>

                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black mb-3">
                                Algoritma dan Pemrograman 🚀
                            </h1>

                            <p class="text-blue-100 max-w-2xl text-sm sm:text-base leading-relaxed">
                                Jelajahi materi, kerjakan evaluasi, dan tingkatkan peringkatmu dalam pembelajaran algoritma dan pemrograman.
                            </p>
                        </div>

                        {{-- ICON --}}
                        <div class="hidden sm:flex w-20 h-20 rounded-2xl bg-white/10 backdrop-blur-md items-center justify-center border border-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-10 h-10 text-white"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 14l6.16-3.422A12.083 12.083 0 0112 20.055
                                   a12.083 12.083 0 01-6.16-9.477L12 14z" />
                            </svg>
                        </div>

                    </div>
                </section>


                {{-- QUICK STATS --}}
                <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-lg transition duration-300">
                        <p class="text-sm text-slate-500 mb-2">Total Materi</p>
                        <h3 class="text-3xl font-black text-blue-900">{{ $totalMateri ?? 0 }}</h3>
                        <p class="text-xs text-slate-400 mt-2">Materi pembelajaran tersedia</p>
                    </div>

                    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-lg transition duration-300">
                        <p class="text-sm text-slate-500 mb-2">Total Evaluasi</p>
                        <h3 class="text-3xl font-black text-blue-900">{{ $totalKuis ?? 0 }}</h3>
                        <p class="text-xs text-slate-400 mt-2">Kuis siap dikerjakan</p>
                    </div>

                    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-lg transition duration-300">
                        <p class="text-sm text-slate-500 mb-2">Status Belajar</p>
                        <h3 class="text-3xl font-black text-green-600">Aktif</h3>
                        <p class="text-xs text-slate-400 mt-2">Tetap semangat belajar 🎯</p>
                    </div>

                </section>


                {{-- MENU UTAMA --}}
                <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

                    {{-- Materi --}}
                    <a href="{{ route('siswa.materi.modul') }}"
                        class="group bg-white rounded-[2rem] p-7 border border-slate-200 shadow-sm hover:shadow-2xl hover:-translate-y-1 transition duration-300">

                        <div class="flex items-start justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center group-hover:scale-110 transition">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-7 h-7 text-blue-600"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7 8h10M7 12h6m2 8H7a2 2 0 01-2-2V6a2 2 0 012-2h7l4 4v12a2 2 0 01-2 2z" />
                                </svg>
                            </div>

                            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-blue-50 text-blue-700">
                                {{ $totalMateri ?? 0 }} Item
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-blue-900 mb-2">Materi Pembelajaran</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">
                            Pelajari seluruh modul algoritma dan pemrograman secara bertahap.
                        </p>
                    </a>


                    {{-- Evaluasi --}}
                    <a href="{{ route('siswa.evaluasi.index') }}"
                        class="group bg-white rounded-[2rem] p-7 border border-slate-200 shadow-sm hover:shadow-2xl hover:-translate-y-1 transition duration-300">

                        <div class="flex items-start justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center group-hover:scale-110 transition">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-7 h-7 text-green-600"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5
                                       a2 2 0 012-2h5l5 5v11a2 2 0 01-2 2z" />
                                </svg>
                            </div>

                            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-green-50 text-green-700">
                                {{ $totalKuis ?? 0 }} Kuis
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-blue-900 mb-2">Evaluasi Pembelajaran</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">
                            Uji pemahamanmu melalui kuis interaktif dan raih skor terbaik.
                        </p>
                    </a>


                    {{-- Leaderboard --}}
                    <a href="{{ route('siswa.leaderboard') }}"
                        class="group bg-white rounded-[2rem] p-7 border border-slate-200 shadow-sm hover:shadow-2xl hover:-translate-y-1 transition duration-300">

                        <div class="flex items-start justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-yellow-50 flex items-center justify-center group-hover:scale-110 transition">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-7 h-7 text-yellow-600"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 21h8m-4-4v4m5-10a5 5 0 01-10 0V4h10v7z" />
                                </svg>
                            </div>

                            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-yellow-50 text-yellow-700">
                                Ranking
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-blue-900 mb-2">Leaderboard</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">
                            Lihat posisi peringkatmu dibanding siswa lainnya.
                        </p>
                    </a>

                </section>

            </div>

        </main>
    </div>

</x-app-layout>