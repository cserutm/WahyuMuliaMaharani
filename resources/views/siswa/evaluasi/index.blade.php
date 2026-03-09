<x-app-layout>
   
    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Konten Utama --}}
        <main class="ml-64 pt-16 px-10 pb-16 min-h-screen bg-gray-100">

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

<div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6
            hover:shadow-md hover:border-blue-200
            transition-all duration-300">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">

        {{-- Info --}}
        <div class="flex items-start gap-4">

            {{-- Icon minimalis --}}
            <div class="bg-blue-50 text-blue-600 p-3 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24"
                     stroke-width="1.8" stroke="currentColor"
                     class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                </svg>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wide text-gray-400">
                    Evaluasi {{ $index + 1 }}
                </p>

                <h3 class="font-semibold text-lg text-gray-800 mt-1">
                    {{ $item->judul }}
                </h3>

                <div class="flex flex-wrap text-sm text-gray-500 gap-4 mt-2">
                    <span>{{ $item->pertanyaan_count }} Soal</span>
                </div>
            </div>
        </div>

        {{-- Button --}}
        @if($already)
            <span class="inline-flex items-center justify-center
                         px-5 py-2 text-sm
                         bg-gray-100 text-gray-500
                         rounded-full cursor-not-allowed">
                Sudah Dikerjakan
            </span>
        @else
            <a href="{{ route('siswa.evaluasi.show', $item->id) }}"
               class="inline-flex items-center gap-2
                      px-6 py-2.5 text-sm
                      bg-blue-600 text-white
                      rounded-full
                      hover:bg-blue-700
                      transition-all duration-300">

                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24"
                     stroke-width="1.8" stroke="currentColor"
                     class="w-4 h-4">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M9 5l7 7-7 7"/>
                </svg>

                Kerjakan
            </a>
        @endif

    </div>
</div>

@empty

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-12 text-center">

    <div class="mx-auto w-16 h-16 bg-blue-50 text-blue-600
                rounded-2xl flex items-center justify-center mb-5">

        <svg xmlns="http://www.w3.org/2000/svg"
             fill="none" viewBox="0 0 24 24"
             stroke-width="1.8" stroke="currentColor"
             class="w-8 h-8">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M3 7h18M3 12h18M3 17h18"/>
        </svg>
    </div>

    <h3 class="text-lg font-semibold text-gray-800">
        Belum Ada Evaluasi
    </h3>

    <p class="text-gray-500 mt-2">
        Evaluasi akan muncul setelah guru mengaktifkannya.
    </p>
</div>

    @endforelse
    <div class="mt-8 flex justify-end">
    <a href="{{ url()->previous() }}"
       class="inline-flex items-center gap-2
              px-5 py-2.5 text-sm
              bg-white border border-gray-300
              text-gray-600
              rounded-full
              hover:bg-gray-50 hover:border-gray-400
              transition-all duration-300">

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

        <span>Kembali</span>
    </a>
</div>



           

           
        </main>


</x-app-layout>
