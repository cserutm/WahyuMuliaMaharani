<x-app-layout>
   
    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Konten Utama --}}
    <main class="ml-64 pt-16 px-10 pb-16 min-h-screen bg-gray-100">

    <div class="max-w-4xl mx-auto space-y-8">

        {{-- Header --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-gray-800">
                {{ $kuis->judul }}
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Silakan pilih jawaban yang paling tepat.
            </p>
        </div>

        {{-- Form --}}
        <form action="{{ route('siswa.evaluasi.submit', $kuis->id) }}" method="POST" class="space-y-6">
            @csrf

            @foreach($kuis->pertanyaan as $index => $q)

                <div class="bg-white border border-gray-200 
                            rounded-2xl p-6 shadow-sm">

                    {{-- Nomor Soal --}}
                    <p class="text-sm text-gray-400 mb-2">
                        Soal {{ $index + 1 }}
                    </p>

                    {{-- Pertanyaan --}}
                    <p class="font-medium text-gray-800 mb-4">
                        {{ $q->soal }}
                    </p>

                    {{-- Pilihan Jawaban --}}
                    <div class="space-y-3">

                        @foreach(['a','b','c','d','e'] as $opsi)

                            @php
                                $field = 'opsi_' . $opsi;
                            @endphp

                            <label class="flex items-center gap-3 
                                           p-3 rounded-xl border border-gray-200
                                           cursor-pointer
                                           hover:border-blue-300 hover:bg-blue-50
                                           transition">

                                <input type="radio"
                                       name="jawaban[{{ $q->id }}]"
                                       value="{{ $opsi }}"
                                       class="text-blue-600 focus:ring-blue-500">

                                <span class="text-gray-700">
                                    {{ $q->$field }}
                                </span>

                            </label>

                        @endforeach

                    </div>

                </div>

            @endforeach

            {{-- Submit Button --}}
            <div class="flex justify-end pt-4">
                <button type="submit"
                        class="inline-flex items-center gap-2
                               px-6 py-2.5 text-sm
                               bg-blue-600 text-white
                               rounded-full
                               hover:bg-blue-700
                               transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24"
                         stroke-width="1.8" stroke="currentColor"
                         class="w-4 h-4">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M5 13l4 4L19 7"/>
                    </svg>

                    Submit Jawaban
                </button>
            </div>

        </form>

    </div>

</main>

</x-app-layout>
