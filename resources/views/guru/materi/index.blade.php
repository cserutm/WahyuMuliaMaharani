<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Materi') }}
        </h2>
    </x-slot>

    {{-- Layout Utama --}}
    <div class="flex min-h-screen bg-gray-50 text-gray-800">

        {{-- Sidebar --}}
        @include('guru.sidebar')

        {{-- Konten --}}
        <main class="flex-1 p-10 overflow-y-auto"
        x-data="{ open: false, tipe: '' }">

            {{-- Header Konten (Judul + Tombol) --}}
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Kelola Materi</h1>

                <button
           @click="open = true; tipe = ''; $nextTick(() => $refs.form.reset())"

            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg">
             <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4" />
                    </svg>
             Tambah Materi
                </button>


                
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-xl shadow overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100">
    <tr class="text-gray-600">
        <th class="px-6 py-3 text-left">No</th>
        <th class="px-6 py-3 text-left">Judul</th>
        <th class="px-6 py-3 text-left">Deskripsi</th>
        <th class="px-6 py-3 text-left">Tujuan Pembelajaran</th>
        <th class="px-6 py-3 text-left">File</th>
        <th class="px-6 py-3 text-left">Dibuat</th>
        <th class="px-6 py-3 text-center">Aksi</th>
    </tr>
</thead>

                    <tbody class="divide-y">
                        @forelse ($moduls as $index => $modul)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-3">{{ $index + 1 }}</td>
                                <td class="px-6 py-3">{{ $materi->judul }}</td>

<td class="px-6 py-3">{{ $materi->deskripsi }}</td>

<td class="px-6 py-3">{{ $materi->tujuan_pembelajaran }}</td>

<td class="px-6 py-3">
    @if($materi->file_materi)
        <a href="{{ asset('storage/' . $materi->file_materi) }}"
           class="text-blue-600 underline" target="_blank">
           Lihat File
        </a>
    @else
        -
    @endif
</td>

                                {{-- Created At --}}
                                <td class="px-6 py-3 text-gray-600">
                                    {{ $modul->created_at->format('d M Y H:i') }}
                                </td>

                                {{-- Aksi --}}
                                <td class="px-4 py-3">
                                    <div class="flex justify-center items-center gap-3">

                                        {{-- Edit --}}
                                        <a href="{{ route('guru.materi.edit', $materi->id) }}"
                                           class="flex items-center gap-1 text-blue-600 hover:text-blue-800">
                                            ✏️ <span class="hidden sm:inline">Edit</span>
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('guru.materi.destroy', $materi->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin hapus materi ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="flex items-center gap-1 text-red-600 hover:text-red-800">
                                                🗑️ <span class="hidden sm:inline">Hapus</span>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                    Belum ada materi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
      action="{{ route('guru.materi.store') }}"
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


            </div>

        </main>
    </div>

</x-app-layout>
