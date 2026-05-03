<x-app-layout>

    <div class="flex">

        {{-- Sidebar --}}
        @include('guru.sidebar')

        {{-- Konten --}}
        <main class="flex-1 ml-0 lg:ml-64 p-4 sm:p-6 lg:p-8 space-y-8"
            x-data="{
                open:false,
                openEdit:false,
                editId:null,
                soalEdit:'',
                opsiAEdit:'',
                opsiBEdit:'',
                opsiCEdit:'',
                opsiDEdit:'',
                opsiEEdit:'',
                jawabanEdit:'',
                gambarSoalLama:'',
                gambarAEdit:'',
                gambarBEdit:'',
                gambarCEdit:'',
                gambarDEdit:'',
                gambarEEdit:''
            }">

            {{-- ================= HEADER ================= --}}
            <section class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-blue-900 via-blue-700 to-indigo-700 p-6 sm:p-8 text-white shadow-xl">

                <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold">
                            Kelola Soal
                        </h1>
                        <p class="text-blue-100 mt-2 text-sm sm:text-base">
                            {{ $kuis->judul }}
                        </p>
                    </div>

                    <button
                        @click="open=true"
                        class="inline-flex items-center justify-center gap-2
                               px-5 py-3
                               bg-white/15 backdrop-blur-md
                               border border-white/20
                               text-white rounded-2xl
                               hover:bg-white/25 transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="w-5 h-5">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 4v16m8-8H4" />
                        </svg>

                        Tambah Soal
                    </button>

                </div>
            </section>


            {{-- ================= TABLE CARD ================= --}}
            <section class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">

                <div class="p-6 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">
                        Daftar Pertanyaan Kuis
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Kelola semua soal evaluasi yang akan dikerjakan siswa
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[700px] text-sm">

                        <thead class="bg-gray-50 border-b">
                            <tr class="text-gray-600">
                                <th class="px-6 py-4 text-left">No</th>
                                <th class="px-6 py-4 text-left">Soal</th>
                                <th class="px-6 py-4 text-left">Jawaban</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">

                            @forelse($kuis->pertanyaan as $index => $item)
                            <tr class="hover:bg-blue-50/30 transition">

                                <td class="px-6 py-5 text-gray-500 align-top">
                                    {{ $index+1 }}
                                </td>

                                <td class="px-6 py-5 text-gray-700 align-top">
                                    <div class="max-w-xl">
                                        <p class="font-medium leading-relaxed">
                                            {{ $item->soal }}
                                        </p>

                                        @if($item->gambar_soal)
                                        <img src="{{ asset('storage/'.$item->gambar_soal) }}"
                                            class="w-28 mt-3 rounded-xl border shadow-sm">
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-5 align-top">
                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-semibold uppercase">
                                        {{ $item->jawaban_benar }}
                                    </span>
                                </td>

                                <td class="px-6 py-5 align-top">
                                    <div class="flex items-center justify-center gap-3">

                                        {{-- EDIT --}}
                                        <button
                                            @click="openEdit=true; 
                                                    editId={{ $item->id }};
                                                    soalEdit=`{{ $item->soal }}`;
                                                    opsiAEdit=`{{ $item->opsi_a }}`;
                                                    opsiBEdit=`{{ $item->opsi_b }}`;
                                                    opsiCEdit=`{{ $item->opsi_c }}`;
                                                    opsiDEdit=`{{ $item->opsi_d }}`;
                                                    opsiEEdit=`{{ $item->opsi_e }}`;
                                                    jawabanEdit=`{{ $item->jawaban_benar }}`;
                                                    gambarSoalLama=`{{ $item->gambar_soal }}`;
                                                    gambarAEdit=`{{ $item->gambar_opsi_a }}`;
                                                    gambarBEdit=`{{ $item->gambar_opsi_b }}`;
                                                    gambarCEdit=`{{ $item->gambar_opsi_c }}`;
                                                    gambarDEdit=`{{ $item->gambar_opsi_d }}`;
                                                    gambarEEdit=`{{ $item->gambar_opsi_e }}`"
                                            class="p-2 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-100 transition">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-4 h-4"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11
                                                         a2 2 0 002 2h11a2 2 0 002-2v-5
                                                         m-1.414-9.414
                                                         a2 2 0 112.828 2.828L11.828 15
                                                         H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>

                                        {{-- DELETE --}}
                                        <form action="{{ route('guru.kuis.pertanyaan.destroy', [$kuis->id, $item->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin hapus soal ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="p-2 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 transition">

                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-4 h-4"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                                                             a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-14 text-center text-gray-400">
                                    Belum ada soal tersedia
                                </td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </section>


            {{-- ================= MODAL TAMBAH ================= --}}
            <div x-show="open" x-transition class="fixed inset-0 z-50 bg-black/50 overflow-y-auto p-4">

                <div class="bg-white w-full max-w-4xl rounded-[2rem] shadow-2xl mx-auto mt-8 mb-8 p-6 sm:p-8"
                    @click.away="open=false">

                    <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Soal</h2>

                    <form action="{{ route('guru.kuis.pertanyaan.store', $kuis->id) }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="space-y-5">
                        @csrf

                        <textarea name="soal" rows="3" required
                            class="w-full rounded-xl border-gray-300"
                            placeholder="Tulis soal..."></textarea>

                        <input type="file" name="gambar_soal" class="w-full text-sm">

                        <div class="space-y-4">
                            @foreach(['a','b','c','d','e'] as $opsi)
                            <div class="grid md:grid-cols-3 gap-3">
                                <input type="text" name="opsi_{{ $opsi }}"
                                    class="md:col-span-2 rounded-xl border-gray-300"
                                    placeholder="Opsi {{ strtoupper($opsi) }}"
                                    {{ $opsi != 'e' ? 'required' : '' }}>
                                <input type="file" name="gambar_opsi_{{ $opsi }}" class="text-sm">
                            </div>
                            @endforeach
                        </div>

                        <select name="jawaban_benar" required class="w-full rounded-xl border-gray-300">
                            <option value="">-- Pilih Jawaban Benar --</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                            <option value="e">E</option>
                        </select>

                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" @click="open=false"
                                class="px-5 py-2.5 rounded-xl border">
                                Batal
                            </button>

                            <button type="submit"
                                class="px-5 py-2.5 rounded-xl bg-blue-600 text-white hover:bg-blue-700">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            {{-- ================= MODAL EDIT ================= --}}
            <div x-show="openEdit" x-transition class="fixed inset-0 z-50 bg-black/50 overflow-y-auto p-4">

                <div class="bg-white w-full max-w-4xl rounded-[2rem] shadow-2xl mx-auto mt-8 mb-8 p-6 sm:p-8"
                    @click.away="openEdit=false">

                    <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Soal</h2>

                    <form :action="'/guru/kuis/{{ $kuis->id }}/pertanyaan/' + editId"
                        method="POST"
                        enctype="multipart/form-data"
                        class="space-y-5">

                        @csrf
                        @method('PUT')

                        <textarea name="soal" x-model="soalEdit" rows="3"
                            class="w-full rounded-xl border-gray-300"></textarea>

                        <template x-if="gambarSoalLama">
                            <img :src="'/storage/' + gambarSoalLama" class="w-24 rounded-xl border">
                        </template>

                        <input type="file" name="gambar_soal" class="w-full text-sm">

                        <div class="space-y-4">
                            @foreach(['A','B','C','D','E'] as $opsi)
                            <div class="grid md:grid-cols-3 gap-3">
                                <input type="text"
                                    :name="'opsi_{{ strtolower($opsi) }}'"
                                    x-model="opsi{{ $opsi }}Edit"
                                    class="md:col-span-2 rounded-xl border-gray-300">
                                <input type="file" :name="'gambar_opsi_{{ strtolower($opsi) }}'" class="text-sm">
                            </div>
                            @endforeach
                        </div>

                        <select name="jawaban_benar" x-model="jawabanEdit" class="w-full rounded-xl border-gray-300">
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                            <option value="e">E</option>
                        </select>

                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" @click="openEdit=false"
                                class="px-5 py-2.5 rounded-xl border">
                                Batal
                            </button>

                            <button type="submit"
                                class="px-5 py-2.5 rounded-xl bg-blue-600 text-white hover:bg-blue-700">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            {{-- BUTTON KEMBALI --}}
            <div class="flex justify-end">
                <a href="{{ route('guru.kuis.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm bg-white border border-gray-300 text-gray-600 rounded-full hover:bg-gray-50 transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="w-4 h-4">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 18l-6-6 6-6" />
                    </svg>

                    Kembali
                </a>
            </div>

        </main>
    </div>
</x-app-layout>