<x-app-layout>
    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Evaluasi
        </h2>
    </x-slot>

    {{-- Layout --}}
    <div class="flex min-h-screen bg-gray-50 text-gray-800">

        {{-- Sidebar --}}
            @include('layouts.sidebar')
        

        {{-- Konten Utama --}}
        <main class="flex-1 p-10 overflow-y-auto">

            {{-- Flash Message --}}
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-6">

    @forelse($kuis as $index => $item)

        @php
            $already = \App\Models\QuizAttempt::where('user_id', auth()->id())
                ->where('kuis_id', $item->id)
                ->exists();
        @endphp

        <div class="bg-white rounded-2xl shadow p-5
                    flex flex-col gap-4
                    sm:flex-row sm:items-center sm:justify-between
                    hover:shadow-lg transition">

            {{-- Kiri --}}
            <div class="flex items-center space-x-4">
                <div class="w-24 h-16 sm:w-32 sm:h-20 bg-blue-300 rounded-xl"></div>

                <div>
                    <p class="text-sm text-gray-500">
                        Kuis {{ $index + 1 }}
                    </p>

                    <h3 class="font-semibold text-base sm:text-lg text-gray-800">
                        {{ $item->judul }}
                    </h3>

                    <div class="flex flex-wrap text-sm text-gray-500 gap-x-4 mt-1">
                        <span>📘 Kelas {{ $item->kelas }}</span>
                        <span>📝 {{ $item->pertanyaan_count }} Soal</span>
                    </div>
                </div>
            </div>

            {{-- Button --}}
            @if($already)
                <span class="w-full sm:w-auto text-center
                               px-4 py-2 bg-gray-300 text-gray-600
                               rounded-full text-sm cursor-not-allowed">
                    Sudah dikerjakan
                </span>
            @else
                <a href="{{ route('siswa.evaluasi.show', $item->id) }}"
                   class="w-full sm:w-auto text-center
                          px-4 py-2 bg-blue-500 text-white
                          rounded-full text-sm
                          hover:bg-blue-600 transition">
                    Kerjakan Kuis
                </a>
            @endif

        </div>

    @empty

        {{-- 🔥 Tampilan Jika Tidak Ada Kuis --}}
        <div class="bg-white rounded-2xl shadow p-10 text-center">
            <div class="text-5xl mb-4">📭</div>
            <h3 class="text-xl font-semibold text-gray-700">
                Kuis Belum Tersedia
            </h3>
            <p class="text-gray-500 mt-2">
                Saat ini belum ada kuis aktif yang dapat dikerjakan.
                Silakan tunggu informasi dari guru.
            </p>
        </div>

    @endforelse

</div>

           

           
        </main>

    </div>
</x-app-layout>
