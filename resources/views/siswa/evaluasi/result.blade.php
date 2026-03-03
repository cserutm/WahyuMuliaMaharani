<x-app-layout>
   
    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Konten Utama --}}
   <main class="ml-64 pt-16 px-10 pb-16 min-h-screen bg-gray-100">

    @php
        $color = $score >= 80 ? 'blue' : ($score >= 70 ? 'green' : ($score >= 50 ? 'yellow' : 'red'));

        if($score >= 80){
            $badge = "Excellent";
            $message = "Luar biasa! Kamu sangat menguasai materi.";
        } elseif($score >= 70){
            $badge = "Good Job";
            $message = "Bagus! Pertahankan semangat belajarmu.";
        } elseif($score >= 50){
            $badge = "Keep Improving";
            $message = "Lumayan! Tingkatkan lagi ya.";
        } else {
            $badge = "Keep Trying";
            $message = "Jangan menyerah, pelajari materi lagi.";
        }
    @endphp

    <div class="max-w-md mx-auto">

        <div class="bg-white border border-gray-200 
                    rounded-3xl shadow-sm p-10 text-center">

            {{-- Score Circle --}}
            <div class="flex justify-center mb-8">
                <div class="w-40 h-40 rounded-full 
                            flex flex-col items-center justify-center
                            border-8
                            {{ $color == 'blue' ? 'border-blue-100 bg-blue-50 text-blue-600' : '' }}
                            {{ $color == 'green' ? 'border-green-100 bg-green-50 text-green-600' : '' }}
                            {{ $color == 'yellow' ? 'border-yellow-100 bg-yellow-50 text-yellow-600' : '' }}
                            {{ $color == 'red' ? 'border-red-100 bg-red-50 text-red-600' : '' }}">

                    <p class="text-sm text-gray-500">Nilai</p>

                    <h2 class="text-4xl font-bold">
                        {{ $score ?? 0 }}
                    </h2>

                    <p class="text-xs text-gray-400">/ 100</p>
                </div>
            </div>

            {{-- Summary --}}
            <div class="bg-gray-50 border border-gray-200 
                        rounded-2xl p-5 mb-6">

                <p class="text-sm font-semibold text-gray-700 mb-3">
                    Ringkasan Hasil
                </p>

                <div class="flex justify-between text-sm text-gray-600">
                    <span>Jawaban Benar</span>
                    <span class="font-semibold">{{ $correct }}</span>
                </div>

                <div class="flex justify-between text-sm text-gray-600 mt-2">
                    <span>Total Soal</span>
                    <span class="font-semibold">{{ $total }}</span>
                </div>

            </div>

            {{-- Badge --}}
            <h3 class="text-lg font-semibold
                {{ $color == 'blue' ? 'text-blue-600' : '' }}
                {{ $color == 'green' ? 'text-green-600' : '' }}
                {{ $color == 'yellow' ? 'text-yellow-600' : '' }}
                {{ $color == 'red' ? 'text-red-600' : '' }}">
                {{ $badge }}
            </h3>

            <p class="text-gray-600 mt-2 text-sm">
                {{ $message }}
            </p>

            {{-- Button --}}
            <div class="mt-8 flex justify-center">
                <a href="{{ route('siswa.evaluasi.index') }}"
                   class="inline-flex items-center gap-2
                          px-6 py-2.5 text-sm
                          bg-white border border-gray-300
                          text-gray-600
                          rounded-full
                          hover:bg-gray-50 hover:border-gray-400
                          transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         class="w-4 h-4">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M15 18l-6-6 6-6"/>
                    </svg>

                    Kembali ke Evaluasi
                </a>
            </div>

        </div>

    </div>

</main>


</x-app-layout>
