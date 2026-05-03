<x-app-layout>

    @include('layouts.sidebar')

    <main class="ml-64 pt-16 px-10 pb-16 min-h-screen bg-gray-100">

        <div class="max-w-4xl mx-auto space-y-8">

            {{-- HEADER --}}
            <div class="bg-white border rounded-2xl p-6 shadow-sm">
                <h2 class="text-xl font-semibold">{{ $kuis->judul }}</h2>
                <p class="text-sm text-gray-500">Tarik jawaban yang benar ke kotak jawaban pada masing-masing soal</p>
            </div>

            <form action="{{ route('siswa.evaluasi.submit', $kuis->id) }}" method="POST" id="quizForm">
                @csrf

                <input type="hidden" name="jawaban_data" id="jawaban_data">

                {{-- LOOP SEMUA SOAL --}}
                @foreach($kuis->pertanyaan as $index => $q)

                <div class="bg-white border rounded-2xl p-6 shadow-sm mb-8">

                    {{-- Nomor Soal --}}
                    <p class="text-sm text-gray-400 mb-1">Soal {{ $index + 1 }}</p>

                    {{-- Pertanyaan --}}
                    <p class="font-medium text-gray-800 mb-4 text-lg">
                        {{ $q->soal }}
                    </p>

                    {{-- Gambar jika ada --}}
                    @if($q->gambar_soal)
                    <img src="{{ asset('storage/'.$q->gambar_soal) }}"
                        class="w-48 rounded-xl border mb-5 shadow-sm">
                    @endif

                    {{-- DROP ZONE --}}
                    <div class="mb-5">
                        <p class="text-sm text-gray-500 mb-2">Tempatkan jawaban di sini:</p>

                        <div class="drop-zone border-2 border-dashed border-blue-300 rounded-xl p-4 min-h-[65px] bg-blue-50 flex items-center justify-center text-gray-400 font-semibold"
                            data-question="{{ $q->id }}">
                            Tarik jawaban ke sini
                        </div>
                    </div>

                    {{-- PILIHAN JAWABAN KHUSUS SOAL INI --}}
                    <div>
                        <p class="text-sm text-gray-500 mb-3">Pilihan Jawaban:</p>

                        <div class="flex flex-wrap gap-3">
                            @foreach(['a','b','c','d','e'] as $opsi)
                            @php
                            $field = 'opsi_'.$opsi;
                            @endphp

                            @if($q->$field)
                            <div class="drag-item bg-blue-100 hover:bg-blue-200 px-4 py-2 rounded-xl cursor-move shadow-sm transition"
                                draggable="true"
                                data-value="{{ $opsi }}"
                                data-question="{{ $q->id }}"
                                data-text="{{ $q->$field }}">

                                {{ $q->$field }}
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>

                </div>

                @endforeach

                {{-- BUTTON --}}
                <div class="flex justify-end">
                    <button class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow">
                        Submit Jawaban
                    </button>
                </div>

            </form>

        </div>
    </main>


    {{-- SCRIPT DRAG DROP --}}
    <script>
        let jawaban = {};

        document.querySelectorAll('.drag-item').forEach(item => {

            item.addEventListener('dragstart', e => {
                e.dataTransfer.setData('value', item.dataset.value);
                e.dataTransfer.setData('question', item.dataset.question);
                e.dataTransfer.setData('text', item.dataset.text);
            });

        });

        document.querySelectorAll('.drop-zone').forEach(zone => {

            zone.addEventListener('dragover', e => {
                e.preventDefault();
                zone.classList.add('bg-blue-100');
            });

            zone.addEventListener('dragleave', () => {
                zone.classList.remove('bg-blue-100');
            });

            zone.addEventListener('drop', e => {
                e.preventDefault();

                const value = e.dataTransfer.getData('value');
                const question = e.dataTransfer.getData('question');
                const text = e.dataTransfer.getData('text');

                if (zone.dataset.question == question) {
                    zone.innerHTML = `
                        <div class="bg-green-100 text-green-700 px-4 py-2 rounded-lg">
                            ${text}
                        </div>
                    `;

                    jawaban[question] = value;
                }

                zone.classList.remove('bg-blue-100');
            });

        });

        document.getElementById('quizForm').addEventListener('submit', function() {
            document.getElementById('jawaban_data').value = JSON.stringify(jawaban);
        });
    </script>

</x-app-layout>