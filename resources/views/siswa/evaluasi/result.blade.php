<x-app-layout>
    <div class="flex">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        <main class="flex-1 ml-0 lg:ml-64 p-4 sm:p-6 lg:p-8 space-y-8 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">

            @php
            $score = $score ?? 0;
            $correct = $correct ?? 0;
            $total = $total ?? 0;

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

            <div class="max-w-sm mx-auto">

                {{-- CARD UTAMA --}}
                <div class="bg-white/90 backdrop-blur-md 
                        border border-gray-200 
                        rounded-2xl shadow-lg 
                        p-6 text-center
                        transition-all duration-300
                        hover:shadow-2xl hover:scale-[1.02]">

                    {{-- SCORE CIRCLE --}}
                    <div class="flex justify-center mb-6">
                        <div class="w-32 h-32 rounded-full 
                        flex flex-col items-center justify-center
                        border-4
                        transition-all duration-300
                        hover:rotate-2 hover:scale-105

                        {{ $color == 'blue' ? 'border-blue-200 bg-blue-50 text-blue-600 shadow-blue-100' : '' }}
                        {{ $color == 'green' ? 'border-green-200 bg-green-50 text-green-600 shadow-green-100' : '' }}
                        {{ $color == 'yellow' ? 'border-yellow-200 bg-yellow-50 text-yellow-600 shadow-yellow-100' : '' }}
                        {{ $color == 'red' ? 'border-red-200 bg-red-50 text-red-600 shadow-red-100' : '' }}">

                            <p class="text-xs text-gray-500">Nilai</p>

                            <h2 class="text-3xl font-extrabold tracking-tight">
                                {{ $score }}
                            </h2>

                            <p class="text-[10px] text-gray-400">/ 100</p>
                        </div>
                    </div>

                    {{-- SUMMARY --}}
                    <div class="bg-gray-50/80 border border-gray-200 
                            rounded-xl p-4 mb-5 text-sm">

                        <p class="font-semibold text-gray-700 mb-3">
                            Ringkasan Hasil
                        </p>

                        <div class="flex justify-between text-gray-600">
                            <span>Jawaban Benar</span>
                            <span class="font-bold text-gray-800">{{ $correct }}</span>
                        </div>

                    </div>

                    {{-- BADGE --}}
                    <h3 class="text-base font-bold tracking-wide
                    transition-all duration-300
                    {{ $color == 'blue' ? 'text-blue-600' : '' }}
                    {{ $color == 'green' ? 'text-green-600' : '' }}
                    {{ $color == 'yellow' ? 'text-yellow-600' : '' }}
                    {{ $color == 'red' ? 'text-red-600' : '' }}">
                        {{ $badge }}
                    </h3>

                    <p class="text-gray-600 mt-2 text-xs leading-relaxed">
                        {{ $message }}
                    </p>

                    {{-- BUTTON --}}
                    <div class="mt-6 flex justify-center">
                        <a href="{{ route('siswa.evaluasi.index') }}"
                            class="inline-flex items-center gap-2
                               px-5 py-2 text-xs font-medium
                               bg-white border border-gray-300
                               text-gray-600
                               rounded-full
                               shadow-sm
                               hover:bg-gray-100 hover:shadow-md
                               active:scale-95
                               transition-all duration-200">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                class="w-4 h-4">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 18l-6-6 6-6" />
                            </svg>

                            Kembali
                        </a>
                    </div>

                </div>

            </div>

        </main>
    </div>

</x-app-layout>