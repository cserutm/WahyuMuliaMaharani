<x-app-layout>

    <div class="flex">

        {{-- Sidebar --}}
        @include('guru.sidebar')

        {{-- Konten Utama --}}
        <main class="flex-1 ml-0 lg:ml-64 p-4 sm:p-6 lg:p-8 space-y-8">

            <div class="space-y-8">

                {{-- HEADER PREMIUM --}}
                <section class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-800 p-5 sm:p-8 lg:p-10 text-white shadow-xl">
                    <div class="absolute top-0 right-0 w-56 sm:w-72 h-56 sm:h-72 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    <div class="absolute bottom-0 left-0 w-56 sm:w-72 h-56 sm:h-72 bg-blue-400/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>

                    <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                        <div>
                            <p class="uppercase tracking-[2px] sm:tracking-[3px] text-blue-200 text-[10px] sm:text-xs font-semibold mb-2">
                                Monitoring Prestasi Siswa
                            </p>

                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black mb-3">
                                Peringkat Siswa 🏆
                            </h1>

                            <p class="text-blue-100 max-w-2xl text-xs sm:text-sm lg:text-base leading-relaxed">
                                Pantau hasil evaluasi terbaik siswa berdasarkan akumulasi kuis dan total nilai pembelajaran.
                            </p>
                        </div>

                        <div class="bg-white/10 backdrop-blur-md rounded-2xl px-5 py-4 border border-white/10 w-fit">
                            <p class="text-[10px] sm:text-xs uppercase text-blue-200 font-semibold">
                                Total Peserta
                            </p>
                            <p class="text-2xl sm:text-3xl font-black mt-1">
                                {{ count($leaderboard) }}
                            </p>
                        </div>
                    </div>
                </section>


                {{-- CARD TABLE --}}
                <section class="bg-white p-4 sm:p-6 lg:p-8 rounded-[2rem] shadow-sm border border-slate-200">

                    {{-- FILTER --}}
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 sm:mb-8">
                        <h3 class="text-lg sm:text-xl font-bold text-blue-900">
                            Daftar Ranking Nilai
                        </h3>

                        <form method="GET">
                            <select name="class_id"
                                onchange="this.form.submit()"
                                class="w-full sm:w-auto border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-300 focus:outline-none bg-slate-50 text-slate-700 min-w-[180px]">
                                <option value="">Semua Kelas</option>

                                @foreach($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ $classId == $class->id ? 'selected' : '' }}>
                                    {{ $class->nama_kelas }}
                                </option>
                                @endforeach
                            </select>
                        </form>
                    </div>


                    {{-- TABLE RESPONSIVE --}}
                    <div class="overflow-x-auto rounded-2xl border border-slate-100">
                        <table class="w-full min-w-[720px] text-sm text-left">
                            <thead class="bg-slate-50 text-blue-900 uppercase tracking-wider text-xs">
                                <tr>
                                    <th class="px-4 sm:px-6 py-4">Rank</th>
                                    <th class="px-4 sm:px-6 py-4">Nama</th>
                                    <th class="px-4 sm:px-6 py-4">Kelas</th>
                                    <th class="px-4 sm:px-6 py-4 text-center">Total Kuis</th>
                                    <th class="px-4 sm:px-6 py-4 text-right">Total Nilai</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100 bg-white">
                                @forelse($leaderboard as $index => $row)
                                <tr class="hover:bg-blue-50/40 transition">

                                    {{-- Rank --}}
                                    <td class="px-4 sm:px-6 py-4 font-semibold whitespace-nowrap">
                                        @if($index === 0)
                                        <span class="px-3 py-1 text-xs font-bold bg-yellow-100 text-yellow-700 rounded-full shadow-sm">
                                            🥇 #1
                                        </span>
                                        @elseif($index === 1)
                                        <span class="px-3 py-1 text-xs font-bold bg-slate-200 text-slate-700 rounded-full shadow-sm">
                                            🥈 #2
                                        </span>
                                        @elseif($index === 2)
                                        <span class="px-3 py-1 text-xs font-bold bg-orange-100 text-orange-700 rounded-full shadow-sm">
                                            🥉 #3
                                        </span>
                                        @else
                                        <span class="text-slate-600 font-semibold">
                                            {{ $index + 1 }}
                                        </span>
                                        @endif
                                    </td>

                                    {{-- Nama --}}
                                    <td class="px-4 sm:px-6 py-4 font-semibold text-blue-900 whitespace-nowrap">
                                        {{ $row->user->name }}
                                    </td>

                                    {{-- Kelas --}}
                                    <td class="px-4 sm:px-6 py-4 text-slate-600 whitespace-nowrap">
                                        {{ $row->user->kelas->nama_kelas ?? '-' }}
                                    </td>

                                    {{-- Total Kuis --}}
                                    <td class="px-4 sm:px-6 py-4 text-center whitespace-nowrap">
                                        <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-800 font-semibold text-xs">
                                            {{ $row->total_quiz }} Kuis
                                        </span>
                                    </td>

                                    {{-- Total Nilai --}}
                                    <td class="px-4 sm:px-6 py-4 text-right font-black text-blue-900 text-sm sm:text-base whitespace-nowrap">
                                        {{ $row->total_score }}
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                        Belum ada data ranking siswa
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </section>

            </div>

        </main>
    </div>

</x-app-layout>