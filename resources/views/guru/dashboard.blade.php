<x-app-layout>

    <div class="flex">

        {{-- Sidebar Desktop --}}
        @include('guru.sidebar')

        {{-- Konten --}}
        <main class="flex-1 ml-0 lg:ml-64 p-4 sm:p-6 lg:p-8 space-y-8">

            {{-- HEADER --}}
            <section class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-800 p-5 sm:p-8 lg:p-10 text-white shadow-2xl">
                <div class="absolute top-0 right-0 w-72 h-72 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-400/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>

                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 sm:gap-6">
                    <div>
                        <p class="uppercase tracking-[3px] text-blue-200 text-xs font-semibold mb-2">
                            Dashboard Monitoring Guru
                        </p>
                        <h1 class="text-xl sm:text-3xl lg:text-4xl font-black mb-3 leading-tight">
                            Selamat Datang, Guru 👋
                        </h1>
                        <p class="text-blue-100 max-w-2xl text-sm sm:text-base">
                            Pantau perkembangan evaluasi siswa, rata-rata nilai kuis, dan partisipasi pembelajaran secara real time melalui panel analitik ini.
                        </p>
                    </div>

                    <div class="bg-white/10 backdrop-blur-md rounded-2xl px-5 py-4 border border-white/10 w-fit">
                        <p class="text-xs uppercase text-blue-200 font-semibold">Tanggal Hari Ini</p>
                        <p id="liveDate" class="text-base sm:text-lg font-bold mt-1"></p>
                    </div>
                </div>
            </section>

            {{-- STATISTIK --}}
            <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5 sm:gap-6">

                <div class="rounded-3xl bg-white p-5 sm:p-6 shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-400">Total Kuis</p>
                            <h2 class="text-3xl sm:text-4xl font-black text-blue-900 mt-3">{{ $totalKuis ?? 0 }}</h2>
                        </div>
                        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-xl sm:text-2xl">📝</div>
                    </div>
                </div>

                <div class="rounded-3xl bg-white p-5 sm:p-6 shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-400">Total Siswa</p>
                            <h2 class="text-3xl sm:text-4xl font-black text-blue-900 mt-3">{{ $totalSiswa ?? 0 }}</h2>
                        </div>
                        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-indigo-100 flex items-center justify-center text-xl sm:text-2xl">👨‍🎓</div>
                    </div>
                </div>

                <div class="rounded-3xl bg-white p-5 sm:p-6 shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 sm:col-span-2 xl:col-span-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-400">Total Pengerjaan</p>
                            <h2 class="text-3xl sm:text-4xl font-black text-blue-900 mt-3">{{ $totalAttempt ?? 0 }}</h2>
                        </div>
                        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-xl sm:text-2xl">📊</div>
                    </div>
                </div>

            </section>

            {{-- QUICK INSIGHT --}}
            <section class="grid grid-cols-1 lg:grid-cols-3 gap-5 sm:gap-6">

                <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200 shadow-sm lg:col-span-2">
                    <h3 class="font-bold text-slate-800 text-lg mb-4">Insight Sistem Pembelajaran</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="rounded-2xl bg-blue-50 p-5">
                            <p class="text-xs text-blue-500 font-semibold uppercase">Aktivitas</p>
                            <p class="text-2xl font-black text-blue-900 mt-2">{{ $totalAttempt ?? 0 }}</p>
                        </div>

                        <div class="rounded-2xl bg-indigo-50 p-5">
                            <p class="text-xs text-indigo-500 font-semibold uppercase">Koleksi Kuis</p>
                            <p class="text-2xl font-black text-indigo-900 mt-2">{{ $totalKuis ?? 0 }}</p>
                        </div>

                        <div class="rounded-2xl bg-emerald-50 p-5">
                            <p class="text-xs text-emerald-500 font-semibold uppercase">Peserta</p>
                            <p class="text-2xl font-black text-emerald-900 mt-2">{{ $totalSiswa ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-900 to-indigo-800 rounded-3xl p-5 sm:p-6 text-white shadow-xl">
                    <p class="text-blue-200 uppercase text-xs font-semibold">Status Sistem</p>
                    <h3 class="text-xl sm:text-2xl font-black mt-3">Online & Aktif</h3>
                    <p class="text-sm text-blue-100 mt-3">
                        Dashboard memonitor performa pembelajaran siswa secara real time.
                    </p>
                </div>

            </section>

            {{-- CHART --}}
            <section class="grid grid-cols-1 xl:grid-cols-2 gap-5 sm:gap-6 pb-8">

                <div class="bg-white rounded-3xl p-5 sm:p-6 shadow-sm border border-slate-200">
                    <h3 class="text-lg font-bold text-slate-800 mb-6">Rata-rata Nilai per Kuis</h3>

                    @if (!empty($labels) && count($labels) > 0)
                    <div class="w-full overflow-x-auto">
                        <canvas id="averageChart" class="min-w-[500px]"></canvas>
                    </div>
                    @else
                    <div class="text-slate-400 text-center py-16">Belum ada data kuis.</div>
                    @endif
                </div>

                <div class="bg-white rounded-3xl p-5 sm:p-6 shadow-sm border border-slate-200">
                    <h3 class="text-lg font-bold text-slate-800 mb-6">Partisipasi Siswa</h3>

                    @if (!empty($labels) && count($labels) > 0)
                    <div class="w-full overflow-x-auto">
                        <canvas id="attemptChart" class="min-w-[500px]"></canvas>
                    </div>
                    @else
                    <div class="text-slate-400 text-center py-16">Belum ada aktivitas siswa.</div>
                    @endif
                </div>

            </section>

        </main>
    </div>

    @if (!empty($labels) && count($labels) > 0)
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = @json($labels ?? []);
        const averageScores = @json($averageScores ?? []);
        const totalAttempts = @json($totalAttempts ?? []);

        function createGradient(ctx, c1, c2) {
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, c1);
            gradient.addColorStop(1, c2);
            return gradient;
        }

        const avgCtx = document.getElementById('averageChart').getContext('2d');
        const avgGradient = createGradient(avgCtx, "rgba(30,58,138,0.9)", "rgba(99,102,241,0.2)");

        new Chart(avgCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    data: averageScores,
                    backgroundColor: avgGradient,
                    borderRadius: 12,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            autoSkip: false
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });

        const atCtx = document.getElementById('attemptChart').getContext('2d');
        const atGradient = createGradient(atCtx, "rgba(16,185,129,0.5)", "rgba(16,185,129,0.03)");

        new Chart(atCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    data: totalAttempts,
                    borderColor: "#10B981",
                    backgroundColor: atGradient,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: "#fff",
                    pointBorderColor: "#10B981",
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            autoSkip: false
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const today = new Date();
        document.getElementById('liveDate').innerHTML = today.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    </script>
    @endif

</x-app-layout>