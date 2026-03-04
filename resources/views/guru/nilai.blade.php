<x-app-layout>

<div class="flex">

@include('guru.sidebar')

<main class="flex-1 ml-64 p-10">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">
            Daftar Nilai Siswa
        </h1>
        <p class="text-sm text-gray-500">
            Rekap hasil evaluasi pembelajaran
        </p>
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-sm text-gray-500">Total Attempt</p>
            <p class="text-2xl font-bold text-gray-800">
                {{ $attempts->count() }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-sm text-gray-500">Nilai Tertinggi</p>
            <p class="text-2xl font-bold text-green-600">
                {{ $attempts->max('score') ?? 0 }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-sm text-gray-500">Nilai Rata-rata</p>
            <p class="text-2xl font-bold text-blue-600">
                {{ $attempts->avg('score') ? round($attempts->avg('score'),1) : 0 }}
            </p>
        </div>

    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-gray-50 border-b">
                    <tr class="text-gray-600">
                        <th class="px-6 py-4 text-left">No</th>
                        <th class="px-6 py-4 text-left">Nama Siswa</th>
                        <th class="px-6 py-4 text-left">Nama Kuis</th>
                        <th class="px-6 py-4 text-center">Nilai</th>
                        <th class="px-6 py-4 text-right">Waktu Submit</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse ($attempts as $index => $attempt)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- No --}}
                        <td class="px-6 py-4 text-gray-500">
                            {{ $index + 1 }}
                        </td>

                        {{-- Nama Siswa --}}
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ $attempt->user->name }}
                        </td>

                        {{-- Nama Kuis --}}
                        <td class="px-6 py-4 text-gray-600">
                            {{ $attempt->kuis->judul ?? '-' }}
                        </td>

                        {{-- Nilai Badge --}}
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                {{ $attempt->score >= 75 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                {{ $attempt->score }}
                            </span>
                        </td>

                        {{-- Waktu --}}
                        <td class="px-6 py-4 text-right text-gray-500 whitespace-nowrap">
                            {{ $attempt->created_at->format('d M Y H:i') }}
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5"
                            class="px-6 py-10 text-center text-gray-400">
                            Belum ada siswa yang mengerjakan kuis
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

</main>

</div>
</x-app-layout>