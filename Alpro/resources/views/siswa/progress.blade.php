<x-app-layout>

    @include('layouts.sidebar')

    <main class="flex-1 ml-0 lg:ml-64 p-4 sm:p-6 lg:p-8 space-y-8">

        <div class="max-w-7xl mx-auto space-y-8">

            {{-- HERO HEADER --}}
            <section class="relative overflow-hidden rounded-[2rem]
                            bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-800
                            p-6 sm:p-8 lg:p-10 text-white shadow-2xl">

                <div class="absolute top-0 right-0 w-72 h-72 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-400/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>

                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <div>
                        <p class="uppercase tracking-[3px] text-blue-200 text-xs font-semibold mb-3">
                            Monitoring Pembelajaran
                        </p>

                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black mb-3">
                            📈 Progress Belajar Saya
                        </h1>

                        <p class="text-blue-100 max-w-2xl text-sm sm:text-base leading-relaxed">
                            Pantau perkembangan belajar, penyelesaian kuis, dan pencapaian hasil evaluasi secara mandiri.
                        </p>
                    </div>

                    <div class="bg-white/10 backdrop-blur-md rounded-2xl px-6 py-4 border border-white/10">
                        <p class="text-xs uppercase text-blue-200 font-semibold">
                            Progress Saat Ini
                        </p>

                        <p class="text-3xl font-black">
                            {{ $progress }}%
                        </p>
                    </div>


                </div>

            </section>

            {{-- PROGRESS BAR --}}
            <section class="bg-white rounded-[2rem] border border-slate-200 shadow-sm p-6 sm:p-8">

                <div class="flex justify-between mb-3">
                    <span class="font-semibold text-blue-900">
                        Progress Pembelajaran
                    </span>

                    <span class="font-bold text-blue-700">
                        {{ $progress }}%
                    </span>
                </div>

                <div class="w-full bg-slate-200 rounded-full h-5 overflow-hidden">

                    <div
                        class="h-5 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 transition-all duration-700"
                        style="width: {{ $progress }}%">
                    </div>

                </div>

                <p class="text-sm text-slate-500 mt-3">
                    Anda telah menyelesaikan {{ $kuisSelesai }} dari {{ $totalKuis }} kuis yang tersedia.
                </p>

            </section>

            {{-- STATISTIK --}}
            <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                <div class="bg-white rounded-[1.5rem] border border-slate-200 p-6 shadow-sm">
                    <p class="text-sm text-slate-500 mb-2">
                        Total Kuis
                    </p>

                    <h3 class="text-3xl font-black text-blue-900">
                        {{ $totalKuis }}
                    </h3>
                </div>

                <div class="bg-white rounded-[1.5rem] border border-slate-200 p-6 shadow-sm">
                    <p class="text-sm text-slate-500 mb-2">
                        Kuis Selesai
                    </p>

                    <h3 class="text-3xl font-black text-green-600">
                        {{ $kuisSelesai }}
                    </h3>
                </div>

                <div class="bg-white rounded-[1.5rem] border border-slate-200 p-6 shadow-sm">
                    <p class="text-sm text-slate-500 mb-2">
                        Total Nilai
                    </p>

                    <h3 class="text-3xl font-black text-indigo-600">
                        {{ $totalScore }}
                    </h3>
                </div>

                <div class="bg-white rounded-[1.5rem] border border-slate-200 p-6 shadow-sm">
                    <p class="text-sm text-slate-500 mb-2">
                        Rata-rata Nilai
                    </p>

                    <h3 class="text-3xl font-black text-yellow-600">
                        {{ $averageScore }}
                    </h3>
                </div>

            </section>

        </div>

    </main>

</x-app-layout>