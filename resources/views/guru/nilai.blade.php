<x-app-layout>

    <div class="flex">

        @include('guru.sidebar')

        <main class="flex-1 ml-0 lg:ml-64 p-4 sm:p-6 lg:p-8 space-y-8">

            <div class="space-y-8">

                {{-- HEADER --}}
                <section class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-800 p-8 sm:p-10 text-white shadow-2xl">
                    <div class="absolute top-0 right-0 w-72 h-72 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-400/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>

                    <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        <div>
                            <p class="uppercase tracking-[3px] text-blue-200 text-xs font-semibold mb-2">
                                Rekap Evaluasi Pembelajaran
                            </p>
                            <h1 class="text-2xl sm:text-4xl font-black mb-3">
                                Daftar Nilai Siswa 📘
                            </h1>
                            <p class="text-blue-100 max-w-2xl text-sm sm:text-base">
                                Lihat seluruh hasil pengerjaan evaluasi siswa, performa nilai, dan histori submit kuis secara terstruktur.
                            </p>
                        </div>

                        <div class="bg-white/10 backdrop-blur-md rounded-2xl px-6 py-4 border border-white/10">
                            <p class="text-xs uppercase text-blue-200 font-semibold">Total Data</p>
                            <p class="text-2xl font-black mt-1">{{ $attempts->count() }}</p>
                        </div>
                    </div>
                </section>

                {{-- STATISTIK --}}
                <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

                    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 hover:shadow-xl transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-400">Total Attempt</p>
                                <h2 class="text-4xl font-black text-blue-900 mt-3">{{ $attempts->count() }}</h2>
                            </div>
                            <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-2xl">📝</div>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 hover:shadow-xl transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-400">Nilai Tertinggi</p>
                                <h2 class="text-4xl font-black text-emerald-600 mt-3">{{ $attempts->max('score') ?? 0 }}</h2>
                            </div>
                            <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-2xl">🏆</div>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 hover:shadow-xl transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-400">Nilai Rata-rata</p>
                                <h2 class="text-4xl font-black text-indigo-600 mt-3">
                                    {{ $attempts->avg('score') ? round($attempts->avg('score'), 1) : 0 }}
                                </h2>
                            </div>
                            <div class="w-14 h-14 rounded-2xl bg-indigo-100 flex items-center justify-center text-2xl">📊</div>
                        </div>
                    </div>

                </section>

                {{-- FILTER + EXPORT --}}
                <section class="bg-white rounded-[2rem] p-6 border border-slate-200 shadow-sm">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                        <h3 class="text-xl font-bold text-blue-900">
                            Data Nilai Evaluasi
                        </h3>

                        <form action="{{ route('nilai.export') }}" method="GET" class="flex flex-col sm:flex-row gap-3">

                            <select name="kelas_id"
                                class="border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-300 focus:outline-none bg-slate-50 text-slate-700 min-w-[180px]">
                                <option value="">Semua Kelas</option>
                                @foreach (\App\Models\Classes::all() as $kelas)
                                <option value="{{ $kelas->id }}">
                                    {{ $kelas->nama_kelas }}
                                </option>
                                @endforeach
                            </select>

                            <button type="submit"
                                class="bg-emerald-600 text-white px-5 py-3 rounded-xl font-semibold hover:bg-emerald-700 transition shadow-md">
                                Download Excel
                            </button>

                        </form>
                    </div>
                </section>

                {{-- TABLE --}}
                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm min-w-[900px]">

                            <thead class="bg-slate-50 border-b text-blue-900 uppercase tracking-wider text-xs">
                                <tr>
                                    <th class="px-6 py-4 text-left">No</th>
                                    <th class="px-6 py-4 text-left">Nama Siswa</th>
                                    <th class="px-6 py-4 text-left">Kelas</th>
                                    <th class="px-6 py-4 text-left">Nama Kuis</th>
                                    <th class="px-6 py-4 text-center">Nilai</th>
                                    <th class="px-6 py-4 text-right">Waktu Submit</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">

                                @forelse ($attempts as $index => $attempt)
                                <tr class="hover:bg-blue-50/40 transition">

                                    <td class="px-6 py-4 text-slate-500 font-medium">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-6 py-4 font-semibold text-blue-900 whitespace-nowrap">
                                        {{ $attempt->user->name }}
                                    </td>

                                    <td class="px-6 py-4 text-slate-600 whitespace-nowrap">
                                        {{ $attempt->user->kelas->nama_kelas ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $attempt->kuis->judul ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold
                                                {{ $attempt->score >= 75 ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-600' }}">
                                            {{ $attempt->score }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-right text-slate-500 whitespace-nowrap">
                                        {{ $attempt->created_at->format('d M Y H:i') }}
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                        Belum ada siswa yang mengerjakan kuis
                                    </td>
                                </tr>
                                @endforelse

                            </tbody>

                        </table>
                    </div>

                </div>

            </div>

        </main>

    </div>
</x-app-layout>