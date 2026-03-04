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

    // =============================
    // 🔹 GRADIENT FUNCTION
    // =============================
    function createGradient(ctx, color1, color2) {
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, color1);
        gradient.addColorStop(1, color2);
        return gradient;
    }

    // =============================
    // 🔹 AVERAGE SCORE (BAR)
    // =============================
    const avgCtx = document.getElementById('averageChart').getContext('2d');

    const avgGradient = createGradient(
        avgCtx,
        "rgba(59, 130, 246, 0.8)",   // biru
        "rgba(99, 102, 241, 0.3)"    // indigo
    );

    new Chart(avgCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Rata-rata Nilai',
                data: averageScores,
                backgroundColor: avgGradient,
                borderRadius: 10,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: "#374151",
                        font: { size: 13 }
                    }
                },
                tooltip: {
                    backgroundColor: "#111827",
                    titleColor: "#fff",
                    bodyColor: "#fff",
                    padding: 12,
                    cornerRadius: 8
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: "#6B7280" }
                },
                y: {
                    beginAtZero: true,
                    max: 100,
                    grid: {
                        color: "rgba(0,0,0,0.05)"
                    },
                    ticks: { color: "#6B7280" }
                }
            }
        }
    });

    // =============================
    // 🔹 PARTISIPASI SISWA (LINE)
    // =============================
    const attemptCtx = document.getElementById('attemptChart').getContext('2d');

    const attemptGradient = createGradient(
        attemptCtx,
        "rgba(16, 185, 129, 0.5)",   // emerald
        "rgba(16, 185, 129, 0.05)"
    );

    new Chart(attemptCtx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Siswa',
                data: totalAttempts,
                borderColor: "#10B981", // emerald
                backgroundColor: attemptGradient,
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
            plugins: {
                legend: {
                    labels: {
                        color: "#374151",
                        font: { size: 13 }
                    }
                },
                tooltip: {
                    backgroundColor: "#111827",
                    titleColor: "#fff",
                    bodyColor: "#fff",
                    padding: 12,
                    cornerRadius: 8
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: "#6B7280" }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: "rgba(0,0,0,0.05)"
                    },
                    ticks: { color: "#6B7280" }
                }
            }
        }
    });
</script>

    @endif

</x-app-layout>