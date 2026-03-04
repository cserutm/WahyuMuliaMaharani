<x-app-layout>

    <div class="flex">

        {{-- Sidebar --}}
        @include('guru.sidebar')

        {{-- Konten --}}
        <main class="flex-1 ml-64 p-10 space-y-10">

            {{-- ===================== --}}
            {{-- 🔹 STATISTIK --}}
            {{-- ===================== --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <p class="text-sm text-gray-400">Total Kuis</p>
                    <h2 class="text-3xl font-semibold mt-3">
                        {{ $totalKuis ?? 0 }}
                    </h2>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <p class="text-sm text-gray-400">Total Siswa</p>
                    <h2 class="text-3xl font-semibold mt-3">
                        {{ $totalSiswa ?? 0 }}
                    </h2>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <p class="text-sm text-gray-400">Total Pengerjaan</p>
                    <h2 class="text-3xl font-semibold mt-3">
                        {{ $totalAttempt ?? 0 }}
                    </h2>
                </div>

            </div>

            {{-- ===================== --}}
            {{-- 🔹 GRAFIK --}}
            {{-- ===================== --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <h3 class="text-lg font-semibold mb-6">
                        Rata-rata Nilai per Kuis
                    </h3>

                    @if(!empty($labels) && count($labels) > 0)
                        <canvas id="averageChart"></canvas>
                    @else
                        <div class="text-gray-500 text-center py-10">
                            Belum ada data kuis.
                        </div>
                    @endif
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <h3 class="text-lg font-semibold mb-6">
                        Partisipasi Siswa
                    </h3>

                    @if(!empty($labels) && count($labels) > 0)
                        <canvas id="attemptChart"></canvas>
                    @else
                        <div class="text-gray-500 text-center py-10">
                            Belum ada aktivitas siswa.
                        </div>
                    @endif
                </div>

            </div>

        </main>

    </div>

    {{-- ===================== --}}
    {{-- 🔹 CHART JS --}}
    {{-- ===================== --}}
    @if(!empty($labels) && count($labels) > 0)

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const labels = @json($labels ?? []);
            const averageScores = @json($averageScores ?? []);
            const totalAttempts = @json($totalAttempts ?? []);

            new Chart(document.getElementById('averageChart'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Rata-rata Nilai',
                        data: averageScores,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    }
                }
            });

            new Chart(document.getElementById('attemptChart'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Siswa',
                        data: totalAttempts,
                        borderWidth: 2,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true
                }
            });
        </script>

    @endif

</x-app-layout>