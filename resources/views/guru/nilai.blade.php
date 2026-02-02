<x-app-layout>
    {{-- Header slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nilai siswa') }}
        </h2>
    </x-slot>

    {{-- Layout --}}
    <div class="flex min-h-screen bg-gray-50 text-gray-800">
        {{-- sidebar --}}
      @include('guru.sidebar')


        {{-- Konten Utama --}}
        <main class="flex-1 p-10 overflow-y-auto">
            <div class="bg-gradient-to-br from-blue-100 to-pink-50 p-6 rounded-2xl shadow text-center block
              transform transition duration-300 hover:shadow-xl hover:-translate-y-1 active:scale-95">

                <h3 class="text-xl font-bold mb-6">
                    Daftar Nilai Siswa
                </h3>

                {{-- Wrapper tabel agar bisa scroll di HP --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse text-sm sm:text-base">
                        <thead>
                            <tr class="border-b text-gray-600">
                                <th class="py-3 px-3 text-left">No</th>
                                <th class="py-3 px-3 text-left">Nama Siswa</th>
                                <th class="py-3 px-3 text-left">Nama Kuis</th>
                                <th class="py-3 px-3 text-center">Nilai</th>
                                <th class="py-3 px-3 text-right">Waktu Submit</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @forelse ($attempts as $index => $attempt)
                                <tr class="hover:bg-gray-50 transition">
                                    {{-- No --}}
                                    <td class="py-3 px-3 text-left">
                                        {{ $index + 1 }}
                                    </td>

                                    {{-- Nama siswa --}}
                                    <td class="py-3 px-3 text-left font-medium">
                                        {{ $attempt->user->name }}
                                    </td>

                                    {{-- Nama kuis --}}
                                    <td class="py-3 px-3 text-left">
                                        {{ $attempt->quiz->judul ?? '-' }}
                                    </td>

                                    {{-- Nilai --}}
                                    <td class="py-3 px-3 text-center font-bold text-blue-600">
                                        {{ $attempt->score }}
                                    </td>

                                    {{-- Waktu --}}
                                    <td class="py-3 px-3 text-right text-gray-500 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($attempt->submitted_at)->format('d M Y H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-gray-500">
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
