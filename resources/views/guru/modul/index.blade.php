<x-app-layout>

    <div class="flex">

        {{-- Sidebar --}}
        @include('guru.sidebar')

        {{-- Konten --}}
        <main class="flex-1 ml-64 p-10 space-y-10"
              x-data="{ open:false, openEdit:false, editId:null }">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Kelola Materi File
                    </h1>
                    <p class="text-sm text-gray-500">
                        Kelola dan atur materi pembelajaran siswa
                    </p>
                </div>

                {{-- Tombol Tambah --}}
                <button
                    @click="open = true; $nextTick(() => $refs.form?.reset())"
                   class="inline-flex items-center gap-2
                   px-4 py-2
                   bg-white border border-blue-200
                   text-blue-600
                   rounded-xl shadow-sm
                   hover:bg-blue-50 transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         class="w-5 h-5">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 4v16m8-8H4"/>
                    </svg>

                    <span>Tambah Materi</span>
                </button>
            </div>

            {{-- Card Table --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">

                        <thead class="bg-gradient-to-r from-blue-50 to-purple-50">
                            <tr class="text-gray-700">
                                <th class="px-6 py-4 text-left">No</th>
                                <th class="px-6 py-4 text-left">Judul</th>
                                <th class="px-6 py-4 text-left">Deskripsi</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">

                            @forelse ($modul as $item)
                                <tr class="hover:bg-gray-50 transition">

                                    <td class="px-6 py-4 text-gray-500">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4 font-semibold">
                                        {{ $item->judul }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $item->deskripsi }}
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center items-center gap-3">

                                            {{-- Detail --}}
                                            <a href="{{ route('guru.modul.show', $item->id) }}"
                                               class="p-2 rounded-full bg-green-100 text-green-600
                                                      hover:bg-green-200 transition shadow-sm">

                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="w-4 h-4"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5
                                                             c4.477 0 8.268 2.943 9.542 7
                                                             -1.274 4.057-5.065 7-9.542 7
                                                             -4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>

                                            {{-- Edit --}}
                                            <button
                                                @click="openEdit=true; editId={{ $item->id }}"
                                                class="p-2 rounded-full bg-blue-100 text-blue-600
                                                       hover:bg-blue-200 transition shadow-sm">

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
                                                             H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </button>

                                            {{-- Hapus --}}
                                            <form action="{{ route('guru.modul.destroy', $item->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin hapus materi ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="p-2 rounded-full bg-red-100 text-red-600
                                                           hover:bg-red-200 transition shadow-sm">

                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="w-4 h-4"
                                                         fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke="currentColor">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                                                                 a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6"/>
                                                    </svg>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="px-6 py-10 text-center text-gray-400">
                                        Belum ada materi
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>


                {{-- MODAL CREATE --}}
<div
    x-cloak
    x-show ="open"
    x-transition
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">

    <div
        @click.away="open = false"
        class="bg-white w-full max-w-xl rounded-2xl shadow-xl p-6">

        <h2 class="text-xl font-bold mb-4">Tambah Materi</h2>
        <form x-ref="form"
      action="{{ route('guru.modul.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="space-y-4">
@csrf

<input type="text" name="judul" required
       placeholder="Judul Materi"
       class="w-full rounded-lg border-gray-300">

<textarea name="deskripsi" rows="2"
          class="w-full rounded-lg border-gray-300"
          placeholder="Deskripsi"></textarea>

<textarea name="tujuan_pembelajaran" rows="2"
          class="w-full rounded-lg border-gray-300"
          placeholder="Tujuan Pembelajaran"></textarea>

<label class="block text-sm font-medium">Upload File Materi (PDF / Word)</label>
<input type="file" name="file_materi"
       accept=".pdf,.doc,.docx"
       class="w-full">

<div class="flex justify-end gap-3">
    <button type="button" @click="open=false"
            class="px-4 py-2 border rounded-lg">
        Batal
    </button>

    <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg">
        Simpan
    </button>
</div>
</form>
    </div>
</div>

     {{-- MODAL EDIT --}}
<div
    x-cloak
    x-show="openEdit"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">

    <div
        @click.away="openEdit=false"
        class="bg-white w-full max-w-xl rounded-2xl shadow-xl p-6">

        <h2 class="text-xl font-bold mb-4">Edit Materi</h2>
            @foreach($modul as $item)
        <form
            action="{{ route('guru.modul.update', $item->id) }}"
           
            method="POST"
            enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            @method('PUT')

            <input type="text" name="judul"
                value="{{ $item->judul }}"
                class="w-full rounded-lg border-gray-300">

            <textarea name="deskripsi" rows="2"
                class="w-full rounded-lg border-gray-300">{{ $item->deskripsi }}</textarea>

            <textarea name="tujuan_pembelajaran" rows="2"
                class="w-full rounded-lg border-gray-300">{{ $item->tujuan_pembelajaran }}</textarea>

            <input type="file" name="file_materi"
                class="w-full">

            <div class="flex justify-end gap-3">
                <button type="button"
                    @click="openEdit=false"
                    class="px-4 py-2 border rounded-lg">
                    Batal
                </button>

                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                    Update
                </button>
            </div>
        </form> @endforeach

    </div>
</div>

 {{-- Button Kembali (Clean Style) --}}
        <div class="mt-10 flex justify-end">
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center gap-2
                      px-5 py-2.5 text-sm
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

                <span>Kembali</span>
            </a>
</div>



            </div>

        </main>
    </div>

</x-app-layout>
