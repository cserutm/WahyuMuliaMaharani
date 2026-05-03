<x-app-layout>

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Konten Utama --}}
    <main class="flex-1 ml-0 lg:ml-64 p-4 sm:p-6 lg:p-8 space-y-8">

        <div class="max-w-7xl mx-auto space-y-8">

            {{-- HERO HEADER (SYNC DASHBOARD STYLE) --}}
            <section class="relative overflow-hidden rounded-[2rem] 
                            bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-800 
                            p-6 sm:p-8 lg:p-10 text-white shadow-2xl">

                <div class="absolute top-0 right-0 w-72 h-72 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-400/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>

                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <div>
                        <p class="uppercase tracking-[3px] text-blue-200 text-xs font-semibold mb-3">
                            Ranking & Kompetisi Siswa
                        </p>

                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black mb-3">
                            🏆 Leaderboard Kelas
                        </h1>

                        <p class="text-blue-100 max-w-2xl text-sm sm:text-base leading-relaxed">
                            Lihat peringkat siswa terbaik di kelas {{ auth()->user()->kelas->nama_kelas }} berdasarkan hasil evaluasi pembelajaran.
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

            {{-- CARD TABLE --}}
            <section class="bg-white rounded-[2rem] border border-slate-200 shadow-sm p-6 sm:p-8">

                <div class="overflow-x-auto">

                    <table class="w-full text-sm text-left">

                        {{-- HEADER --}}
                        <thead class="bg-slate-50 text-blue-900 uppercase text-xs tracking-wider">

                            <tr>
                                <th class="px-6 py-3">Rank</th>
                                <th class="px-6 py-3">Nama</th>
                                <th class="px-6 py-3">Kelas</th>
                                <th class="px-6 py-3 text-center">Total Kuis</th>
                                <th class="px-6 py-3 text-right">Total Nilai</th>
                            </tr>

                        </thead>

                        {{-- BODY --}}
                        <tbody class="divide-y divide-slate-100">

                            @foreach($leaderboard as $index => $row)

                            <tr class="transition duration-200 hover:bg-slate-50
                                {{ $row->user_id == auth()->id() ? 'bg-blue-50' : '' }}">

                                {{-- RANK --}}
                                <td class="px-6 py-4 font-semibold">

                                    @if($index === 0)
                                    <span class="px-3 py-1 text-xs font-bold bg-yellow-100 text-yellow-700 rounded-full">
                                        🥇 #1
                                    </span>
                                    @elseif($index === 1)
                                    <span class="px-3 py-1 text-xs font-bold bg-gray-200 text-gray-700 rounded-full">
                                        🥈 #2
                                    </span>
                                    @elseif($index === 2)
                                    <span class="px-3 py-1 text-xs font-bold bg-orange-100 text-orange-700 rounded-full">
                                        🥉 #3
                                    </span>
                                    @else
                                    <span class="text-slate-600 font-medium">
                                        #{{ $index + 1 }}
                                    </span>
                                    @endif

                                </td>

                                {{-- NAMA --}}
                                <td class="px-6 py-4 font-semibold text-blue-900">
                                    {{ $row->user->name }}
                                </td>

                                {{-- KELAS --}}
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $row->user->kelas->nama_kelas ?? '-' }}
                                </td>

                                {{-- TOTAL KUIS --}}
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 text-xs rounded-full bg-slate-100 text-slate-700">
                                        {{ $row->total_quiz }}
                                    </span>
                                </td>

                                {{-- TOTAL NILAI --}}
                                <td class="px-6 py-4 text-right font-bold text-blue-900">
                                    {{ $row->total_score }}
                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </section>

        </div>

    </main>

</x-app-layout>