<x-app-layout>
  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola kuis') }}
        </h2>
    </x-slot>

    {{-- Layout --}}
    <div class="flex min-h-screen bg-gray-50 text-gray-800">
        {{-- sidebar --}}
      @include('guru.sidebar')

        {{-- Konten Utama --}}
        <main class="flex-1 p-10 overflow-y-auto"
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
    jawabanEdit:''
}">

    <h1 class="text-2xl font-bold mb-6">
        Kelola Soal - {{ $kuis->judul }}
    </h1>

    {{-- Tombol Tambah --}}
    <button @click="open=true"
            class="mb-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
        + Tambah Soal
    </button>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Soal</th>
                    <th class="p-3 text-left">Jawaban</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kuis->pertanyaan as $index => $item)
                <tr class="border-t">
                    <td class="p-3">{{ $index+1 }}</td>
                    <td class="p-3">{{ $item->soal }}</td>
                    <td class="p-3 uppercase">{{ $item->jawaban_benar }}</td>
                    <td class="p-3">
    <div class="flex items-center justify-center gap-3">

        {{-- Edit --}}
        <button
            @click="openEdit=true; 
                    editId={{ $item->id }};
                    soalEdit=`{{ $item->soal }}`;
                    opsiAEdit=`{{ $item->opsi_a }}`;
                    opsiBEdit=`{{ $item->opsi_b }}`;
                    opsiCEdit=`{{ $item->opsi_c }}`;
                    opsiDEdit=`{{ $item->opsi_d }}`;
                    opsiEEdit=`{{ $item->opsi_e }}`;
                    jawabanEdit=`{{ $item->jawaban_benar }}`"
            class="text-blue-600 hover:text-blue-800">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
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

        {{-- Hapus --}}
        <form action="{{ route('guru.kuis.pertanyaan.destroy', [$kuis->id, $item->id]) }}"
              method="POST"
              onsubmit="return confirm('Yakin hapus soal ini?')">
            @csrf
            @method('DELETE')

            <button type="submit"
                class="text-red-600 hover:text-red-800">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                             a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7
                             h6m2 0H7m2-3h6a1 1 0 011 1v1H8V5
                             a1 1 0 011-1z" />
                </svg>
            </button>
        </form>

    </div>
</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">
                        Belum ada soal
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Tambah Soal --}}
    <div x-show="open"
         x-transition
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">

        <div class="bg-white w-full max-w-2xl p-6 rounded-xl shadow-lg"
             @click.away="open=false">

            <h2 class="text-xl font-bold mb-4">Tambah Soal</h2>

            <form action="{{ route('guru.kuis.pertanyaan.store', $kuis->id) }}"
                  method="POST">
                @csrf

                <textarea name="soal"
                          class="w-full border rounded p-2 mb-3"
                          placeholder="Tulis soal..."
                          required></textarea>

                <input type="text" name="opsi_a" class="w-full border p-2 mb-2 rounded" placeholder="Opsi A" required>
                <input type="text" name="opsi_b" class="w-full border p-2 mb-2 rounded" placeholder="Opsi B" required>
                <input type="text" name="opsi_c" class="w-full border p-2 mb-2 rounded" placeholder="Opsi C" required>
                <input type="text" name="opsi_d" class="w-full border p-2 mb-2 rounded" placeholder="Opsi D" required>
                <input type="text" name="opsi_e" class="w-full border p-2 mb-4 rounded" placeholder="Opsi E" required>

                <select name="jawaban_benar"
                        class="w-full border p-2 mb-4 rounded"
                        required>
                    <option value="">-- Pilih Jawaban Benar --</option>
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
                    <option value="e">E</option>
                </select>

                <div class="flex justify-end gap-2">
                    <button type="button"
                            @click="open=false"
                            class="px-4 py-2 bg-gray-400 text-white rounded">
                        Batal
                    </button>

                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
    {{-- Modal Edit Soal --}}
<div x-show="openEdit"
     x-transition
     class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">

    <div class="bg-white w-full max-w-2xl p-6 rounded-xl shadow-lg"
         @click.away="openEdit=false">

        <h2 class="text-xl font-bold mb-4">Edit Soal</h2>

        <form :action="'/guru/kuis/{{ $kuis->id }}/pertanyaan/' + editId"
              method="POST">

            @csrf
            @method('PUT')

            <textarea name="soal"
                      x-model="soalEdit"
                      class="w-full border rounded p-2 mb-3"
                      required></textarea>

            <input type="text" name="opsi_a" x-model="opsiAEdit" class="w-full border p-2 mb-2 rounded" required>
            <input type="text" name="opsi_b" x-model="opsiBEdit" class="w-full border p-2 mb-2 rounded" required>
            <input type="text" name="opsi_c" x-model="opsiCEdit" class="w-full border p-2 mb-2 rounded" required>
            <input type="text" name="opsi_d" x-model="opsiDEdit" class="w-full border p-2 mb-2 rounded" required>
            <input type="text" name="opsi_e" x-model="opsiEEdit" class="w-full border p-2 mb-4 rounded" required>

            <select name="jawaban_benar"
                    x-model="jawabanEdit"
                    class="w-full border p-2 mb-4 rounded"
                    required>
                <option value="a">A</option>
                <option value="b">B</option>
                <option value="c">C</option>
                <option value="d">D</option>
                <option value="e">E</option>
            </select>

            <div class="flex justify-end gap-2">
                <button type="button"
                        @click="openEdit=false"
                        class="px-4 py-2 bg-gray-400 text-white rounded">
                    Batal
                </button>

                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
</main>
</div>
</x-app-layout>