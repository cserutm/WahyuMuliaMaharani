<x-app-layout>

    <div class="flex">

        @include('guru.sidebar')

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        <main class="flex-1 ml-0 lg:ml-64 p-4 sm:p-6 lg:p-8 space-y-8"

            x-data="{
                open:false,
                openEdit:false,
                editId:null,
                editSoal:null
            }"
            x-cloak>

            {{-- ================= HEADER ================= --}}
            <section class="bg-gradient-to-r from-blue-900 to-indigo-700 text-white p-6 rounded-2xl shadow">

                <div class="flex justify-between items-center">

                    <div>
                        <h1 class="text-2xl font-bold">Kelola Soal</h1>
                        <p class="text-blue-100">{{ $kuis->judul }}</p>
                    </div>

                    <button @click="open=true"
                        class="px-5 py-2 bg-white/20 rounded-xl hover:bg-white/30">
                        + Tambah Soal
                    </button>

                </div>

            </section>

            {{-- ================= TABLE ================= --}}
            <section class="bg-white rounded-2xl shadow overflow-hidden">

                <table class="w-full text-sm">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">No</th>
                            <th class="p-3 text-left">Soal</th>
                            <th class="p-3 text-left">Tipe</th>
                            <th class="p-3 text-left">HOTS</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($kuis->pertanyaan as $i => $item)
                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-3">{{ $i+1 }}</td>

                            <td class="p-3">
                                <div class="font-medium">{{ $item->soal }}</div>

                                @if($item->gambar_soal)
                                <img src="{{ asset('storage/'.$item->gambar_soal) }}"
                                    class="w-20 mt-2 rounded">
                                @endif
                            </td>

                            <td class="p-3">
                                <span class="px-2 py-1 text-xs bg-gray-100 rounded">
                                    {{ $item->tipe_soal }}
                                </span>
                            </td>

                            <td class="p-3">
                                <span class="px-2 py-1 text-xs rounded
                                    {{ $item->kategori_hots == 'HOTS'
                                    ? 'bg-red-100 text-red-600'
                                    : 'bg-green-100 text-green-600' }}">
                                    {{ $item->kategori_hots }}
                                </span>
                            </td>

                            <td class="p-3 text-center">

                                {{-- ================= EDIT BUTTON FIX ================= --}}
                                <button
                                    @click="
                                        openEdit=true;
                                        editId={{ $item->id }};
                                        editSoal={{ Js::from($item) }}
                                    "
                                    class="text-blue-600 font-semibold">
                                    Edit
                                </button>

                                <form action="{{ route('guru.kuis.pertanyaan.destroy', [$kuis->id, $item->id]) }}"
                                    method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Hapus soal?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-600 ml-2">
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-400">
                                Belum ada soal
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>

            </section>

            {{-- ================= MODAL TAMBAH ================= --}}
            <div x-show="open"
                x-transition
                x-cloak
                class="fixed inset-0 z-50 bg-black/50 p-4 overflow-y-auto">

                <div class="min-h-full flex items-start justify-center">

                    <div @click.away="open=false"
                        class="bg-white w-full max-w-2xl rounded-2xl p-6
                        max-h-[90vh] overflow-y-auto shadow-xl mt-10">

                        <h2 class="text-xl font-bold mb-4">Tambah Soal</h2>

                        <form action="{{ route('guru.kuis.pertanyaan.store', $kuis->id) }}"
                            method="POST"
                            enctype="multipart/form-data"
                            class="space-y-4">

                            @csrf

                            <textarea name="soal"
                                class="w-full border rounded-xl p-2"
                                placeholder="Tulis soal"></textarea>

                            <select name="tipe_soal"
                                class="w-full border rounded-xl p-2">

                                <option value="card_choice">Card Choice</option>
                                <option value="drag_drop">Drag & Drop</option>
                                <option value="susun_balok">Susun Balok</option>

                            </select>

                            <select name="kategori_hots"
                                class="w-full border rounded-xl p-2">

                                <option value="HOTS">HOTS</option>
                                <option value="LOTS">LOTS</option>

                            </select>

                            <input type="file" name="gambar_soal" class="w-full">

                            @foreach(['a','b','c','d','e'] as $opsi)
                            <input type="text"
                                name="opsi_{{ $opsi }}"
                                class="w-full border rounded-xl p-2"
                                placeholder="Opsi {{ strtoupper($opsi) }}">
                            @endforeach

                            {{-- ================= FIX: WAJIB JSON ================= --}}
                            <textarea name="jawaban_benar"
                                class="w-full border rounded-xl p-2"
                                placeholder='ISI JSON:
"a"
atau ["a","b","c"]'></textarea>

                            <div class="flex justify-end gap-3 pt-3">

                                <button type="button"
                                    @click="open=false"
                                    class="px-4 py-2 border rounded-xl">
                                    Batal
                                </button>

                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-xl">
                                    Simpan
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

            {{-- ================= MODAL EDIT (FULL FIX JSON SUPPORT) ================= --}}
            <div x-show="openEdit"
                x-transition
                x-cloak
                class="fixed inset-0 z-50 bg-black/50 p-4 overflow-y-auto">

                <div class="min-h-full flex items-start justify-center">

                    <div @click.away="openEdit=false"
                        class="bg-white w-full max-w-2xl rounded-2xl p-6
                        max-h-[90vh] overflow-y-auto shadow-xl mt-10">

                        <h2 class="text-xl font-bold mb-4">Edit Soal</h2>

                        <form :action="'/guru/kuis/{{ $kuis->id }}/pertanyaan/' + editId"
                            method="POST"
                            class="space-y-4">

                            @csrf
                            @method('PUT')

                            <textarea name="soal"
                                x-model="editSoal.soal"
                                class="w-full border rounded-xl p-2"></textarea>

                            <select name="tipe_soal"
                                x-model="editSoal.tipe_soal"
                                class="w-full border rounded-xl p-2">

                                <option value="card_choice">Card Choice</option>
                                <option value="drag_drop">Drag & Drop</option>
                                <option value="susun_balok">Susun Balok</option>

                            </select>

                            <select name="kategori_hots"
                                x-model="editSoal.kategori_hots"
                                class="w-full border rounded-xl p-2">

                                <option value="HOTS">HOTS</option>
                                <option value="LOTS">LOTS</option>

                            </select>

                            @foreach(['a','b','c','d','e'] as $opsi)
                            <input type="text"
                                name="opsi_{{ $opsi }}"
                                x-model="editSoal['opsi_{{ $opsi }}']"
                                class="w-full border rounded-xl p-2"
                                placeholder="Opsi {{ strtoupper($opsi) }}">
                            @endforeach

                            {{-- ================= FIX JSON EDIT ================= --}}
                            <textarea name="jawaban_benar"
                                x-model="JSON.stringify(editSoal.jawaban_benar)"
                                class="w-full border rounded-xl p-2"></textarea>

                            <div class="flex justify-end gap-3">

                                <button type="button"
                                    @click="openEdit=false"
                                    class="px-4 py-2 border rounded-xl">
                                    Batal
                                </button>

                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-xl">
                                    Update
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

            {{-- BACK BUTTON --}}
            <div class="flex justify-end">
                <a href="{{ route('guru.kuis.index') }}"
                    class="px-5 py-2 border rounded-full text-gray-600">
                    Kembali
                </a>
            </div>

        </main>

    </div>

</x-app-layout>