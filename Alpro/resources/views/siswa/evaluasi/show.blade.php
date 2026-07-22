<x-app-layout>

    @include('layouts.sidebar')

    <main class="lg:ml-64 pt-16 px-4 sm:px-6 lg:px-10 pb-16 min-h-screen bg-gray-100 overflow-x-hidden">

        <div class="max-w-4xl mx-auto space-y-8">

            <div class="bg-white border rounded-2xl p-6 shadow-sm">
                <h2 class="text-xl font-semibold">{{ $kuis->judul }}</h2>
                <p class="text-sm text-gray-500">Kerjakan semua soal dengan benar</p>
            </div>

            <form action="{{ route('siswa.evaluasi.submit', $kuis->id) }}"
                method="POST"
                id="quizForm">

                @csrf
                <input type="hidden" name="jawaban_data" id="jawaban_data">

                @foreach($kuis->pertanyaan as $index => $q)

                <div class="bg-white border rounded-2xl p-6 shadow-sm mb-8">

                    <p class="text-sm text-gray-400 mb-1">Soal {{ $index + 1 }}</p>

                    {{-- ================= SOAL ================= --}}
                    <p class="font-medium text-gray-800 mb-2 text-lg">
                        {{ $q->soal }}
                    </p>

                    {{-- ================= HOTS LABEL (FIX FINAL) ================= --}}
                    @if(strtoupper(trim($q->kategori_hots ?? '')) === 'HOTS')
                    <span class="inline-block mb-3 px-3 py-1 text-xs font-bold bg-red-500 text-white rounded-full">
                        HOTS
                    </span>
                    @endif

                    {{-- ================= GAMBAR ================= --}}
                    @if($q->gambar_soal)
                    <img src="{{ asset('storage/'.$q->gambar_soal) }}"
                        class="w-48 rounded-xl border mb-5 shadow-sm">
                    @endif


                    {{-- ================= CARD ================= --}}
                    @if($q->tipe_soal == 'card_choice')
                    <div class="grid grid-cols-2 gap-3 mb-4">

                        @foreach(['a','b','c','d','e'] as $opsi)
                        @php $field = 'opsi_'.$opsi; @endphp

                        @if($q->$field)
                        <label class="border p-3 rounded-xl cursor-pointer hover:bg-blue-50 flex gap-2">
                            <input type="radio"
                                name="jawaban_{{ $q->id }}"
                                value="{{ $opsi }}"
                                class="accent-blue-600">
                            <span>{{ $q->$field }}</span>
                        </label>
                        @endif

                        @endforeach

                    </div>
                    @endif


                    {{-- ================= DRAG DROP ================= --}}
                    @if($q->tipe_soal == 'drag_drop')

                    <div class="drop-zone border-2 border-dashed border-blue-300 rounded-xl p-4 min-h-[65px] bg-blue-50 flex items-center justify-center text-gray-400 mb-4"
                        data-question="{{ $q->id }}">

                        <div class="drop-content">
                            Tarik jawaban ke sini
                        </div>

                    </div>

                    <div class="flex flex-wrap gap-3">

                        @foreach(['a','b','c','d','e'] as $opsi)
                        @php $field = 'opsi_'.$opsi; @endphp

                        @if($q->$field)

                        <div class="drag-item bg-blue-100 px-4 py-2 rounded-xl shadow cursor-grab"
                            data-value="{{ $opsi }}"
                            data-text="{{ $q->$field }}">

                            {{ $q->$field }}

                        </div>

                        @endif
                        @endforeach

                    </div>

                    @endif


                    {{-- ================= SUSUN BALOK ================= --}}
                    @if($q->tipe_soal == 'susun_balok')

                    <div id="balok-{{ $q->id }}" class="flex flex-wrap gap-3">

                        @foreach(['a','b','c','d','e'] as $opsi)
                        @php $field = 'opsi_'.$opsi; @endphp

                        @if($q->$field)
                        <div class="balok-item bg-white border px-4 py-2 rounded-xl cursor-move"
                            data-value="{{ $opsi }}">
                            {{ $q->$field }}
                        </div>
                        @endif

                        @endforeach

                    </div>

                    @endif

                </div>

                @endforeach


                <div class="flex justify-end">
                    <button class="px-8 py-3 bg-blue-600 text-white rounded-full shadow">
                        Submit Jawaban
                    </button>
                </div>

            </form>

        </div>

    </main>

    <style>
        .drag-item,
        .balok-item {
            user-select: none;
            cursor: grab;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <script>
        let jawaban = {};

        interact('.drag-item').draggable({
            listeners: {
                move(event) {
                    const target = event.target;

                    let x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                    let y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                    target.style.transform = `translate(${x}px, ${y}px)`;

                    target.setAttribute('data-x', x);
                    target.setAttribute('data-y', y);
                },

                end(event) {
                    const target = event.target;

                    if (!target.classList.contains('dropped')) {
                        resetDrag(target);
                    }
                }
            }
        });

        function resetDrag(el) {
            el.style.transform = 'translate(0px,0px)';
            el.setAttribute('data-x', 0);
            el.setAttribute('data-y', 0);
        }

        interact('.drop-zone').dropzone({
            accept: '.drag-item',
            overlap: 0.3,

            ondrop(event) {

                const item = event.relatedTarget;
                const zone = event.target;

                const qid = zone.dataset.question;
                const text = item.dataset.text;
                const value = item.dataset.value;

                const old = document.querySelector('.drag-item.dropped[data-q="' + qid + '"]');

                if (old) {
                    old.classList.remove('dropped');
                    old.removeAttribute('data-q');
                    resetDrag(old);
                    old.style.opacity = '1';
                    old.style.pointerEvents = 'auto';
                }

                zone.querySelector('.drop-content').innerHTML =
                    `<div class="bg-green-100 text-green-700 px-4 py-2 rounded-lg w-full text-center">${text}</div>`;

                jawaban[qid] = value;

                item.classList.add('dropped');
                item.dataset.q = qid;
                item.style.opacity = '0.4';
                item.style.pointerEvents = 'none';

                resetDrag(item);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[id^="balok-"]').forEach(el => {
                new Sortable(el, {
                    animation: 150
                });
            });
        });

        document.getElementById('quizForm').addEventListener('submit', function() {

            document.querySelectorAll('input[type=radio]:checked').forEach(el => {
                let id = el.name.replace('jawaban_', '');
                jawaban[id] = el.value;
            });

            document.querySelectorAll('[id^="balok-"]').forEach(el => {
                let qid = el.id.replace('balok-', '');
                let arr = [];

                el.querySelectorAll('.balok-item').forEach(i => {
                    arr.push(i.dataset.value);
                });

                jawaban[qid] = arr;
            });

            document.getElementById('jawaban_data').value =
                JSON.stringify(jawaban);
        });
    </script>

</x-app-layout>