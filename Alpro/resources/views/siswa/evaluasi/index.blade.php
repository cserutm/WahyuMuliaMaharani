<x-app-layout>
    <div class="flex">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Konten Utama --}}
        <main class="flex-1 ml-0 lg:ml-64 p-4 sm:p-6 lg:p-8 space-y-8 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">

            {{-- ================= HERO HEADER ================= --}}
            <section class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-800 p-8 text-white shadow-2xl mb-8">

                <div class="absolute top-0 right-0 w-72 h-72 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-400/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>

                {{-- HERO CONTENT --}}
                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <div>
                        <p class="uppercase tracking-[3px] text-blue-200 text-xs font-semibold mb-2">
                            Evaluasi Pembelajaran
                        </p>
                        <h2 class="text-2xl sm:text-4xl font-black mb-3">
                            Kuis & Latihan Soal
                        </h2>
                        <p class="text-blue-100 max-w-2xl text-sm sm:text-base">
                            Kerjakan evaluasi untuk mengukur pemahamanmu terhadap materi Algoritma dan Pemrograman.
                        </p>
                    </div>

                    <div class="bg-white/10 backdrop-blur rounded-3xl px-6 py-5 border border-white/10">
                        <p class="text-xs uppercase text-blue-200 font-semibold">Total Kuis</p>
                        <p class="text-3xl font-black mt-1">{{ $kuis->count() }}</p>
                    </div>

                </div>
            </section>

            {{-- Flash Message --}}
            @if(session('error'))
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-xl border border-red-200 shadow-sm">
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-xl border border-green-200 shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            {{-- ================= LIST KUIS ================= --}}
            <div class="space-y-6 max-w-7xl mx-auto">

                @forelse($kuis as $index => $item)

                @php
                $already = \App\Models\QuizAttempt::where('user_id', auth()->id())
                ->where('kuis_id', $item->id)
                ->exists();
                @endphp

                <div class="bg-white/95 backdrop-blur border border-slate-200 rounded-2xl shadow-sm p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">

                        <div class="flex items-start gap-4">

                            <div class="bg-blue-100 text-blue-700 p-3 rounded-xl">
                                📘
                            </div>

                            <div>
                                <p class="text-xs uppercase tracking-[2px] text-blue-500 font-semibold">
                                    Evaluasi {{ $index + 1 }}
                                </p>

                                <h3 class="font-bold text-lg text-slate-800 mt-1">
                                    {{ $item->judul }}
                                </h3>

                                <div class="text-sm text-slate-500 mt-2">
                                    {{ $item->pertanyaan_count }} Soal
                                </div>
                            </div>

                        </div>

                        @if($already)
                        <span class="px-5 py-2 text-sm bg-slate-100 text-slate-500 rounded-full">
                            Sudah Dikerjakan
                        </span>
                        @else
                        <a href="{{ route('siswa.evaluasi.show', $item->id) }}"
                            class="px-6 py-2.5 text-sm bg-blue-600 text-white rounded-full hover:bg-blue-700 shadow transition">
                            Kerjakan
                        </a>
                        @endif

                    </div>
                </div>

                @empty

                <div class="bg-white/95 border border-slate-200 rounded-2xl shadow-sm p-12 text-center max-w-2xl mx-auto">
                    <h3 class="text-lg font-bold text-slate-800">Belum Ada Evaluasi</h3>
                    <p class="text-slate-500 mt-2">Evaluasi akan muncul setelah guru mengaktifkannya.</p>
                </div>

                @endforelse

            </div>

        </main>
    </div>

</x-app-layout>