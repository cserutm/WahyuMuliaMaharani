<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Guru
        </h2>
    </x-slot>

    <div class="flex min-h-screen bg-gray-50 text-gray-800">

        {{-- Sidebar --}}
        @include('guru.sidebar')

        {{-- Konten --}}
        <main class="flex-1 p-10 overflow-y-auto space-y-8">

            {{-- ===================== --}}
            {{-- 🔵 STATISTIK --}}
            {{-- ===================== --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <p class="text-gray-500 text-sm">Total Kuis</p>
                    <h2 class="text-3xl font-bold text-blue-600 mt-2">
                        {{ $totalKuis }}
                    </h2>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <p class="text-gray-500 text-sm">Total Siswa</p>
                    <h2 class="text-3xl font-bold text-green-600 mt-2">
                        {{ $totalSiswa }}
                    </h2>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <p class="text-gray-500 text-sm">Total Pengerjaan</p>
                    <h2 class="text-3xl font-bold text-purple-600 mt-2">
                        {{ $totalAttempt }}
                    </h2>
                </div>

            </div>

            {{-- ===================== --}}
            {{-- 📊 ANALISIS GRAFIK --}}
            {{-- ===================== --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- Grafik Rata-rata Nilai --}}
                <div class="bg-white p-6 rounded-2xl shadow">
                    <h3 class="text-lg font-semibold mb-4">
                        📈 Rata-rata Nilai Per Kuis
                    </h3>

                    @if(count($labels) > 0)
                        <canvas id="averageChart"></canvas>
                    @else
                        <div class="text-center py-10 text-gray-500">
                            Belum ada data kuis untuk dianalisis.
                        </div>
                    @endif
                </div>

                {{-- Grafik Jumlah Partisipasi --}}
                <div class="bg-white p-6 rounded-2xl shadow">
                    <h3 class="text-lg font-semibold mb-4">
                        👥 Partisipasi Siswa
                    </h3>

                    @if(count($labels) > 0)
                        <canvas id="attemptChart"></canvas>
                    @else
                        <div class="text-center py-10 text-gray-500">
                            Belum ada aktivitas siswa.
                        </div>
                    @endif
                </div>

            </div>

        </main>

    </div>

    {{-- ===================== --}}
    {{-- 📊 CHART JS --}}
    {{-- ===================== --}}
    @if(count($labels) > 0)

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const labels = @json($labels);
            const averageScores = @json($averageScores);
            const totalAttempts = @json($totalAttempts);

            // Grafik 1 - Bar
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

            // Grafik 2 - Line
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