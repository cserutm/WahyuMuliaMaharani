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
        x-data="{
        open:false,
        openEdit:false,
        editId:null
    }">

     {{-- Header Konten (Judul + Tombol) --}}
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Kelola Materi Video</h1>

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
        <th class="px-6 py-3 text-center">Aksi</th>
    </tr>
</thead>

                    <tbody class="divide-y">
                        @forelse ($videos as $index => $video)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-3">{{ $index + 1 }}</td>
                                <td class="px-6 py-3">{{ $video->judul }}</td>
                                <td class="px-6 py-3">{{ $video->deskripsi }}</td>


                              

                                {{-- Aksi --}}
                                <td class="px-4 py-3">
                                    <div class="flex justify-center items-center gap-3">
                                  
                                        <a href="{{ route('guru.video.show', $video->id) }}"
                                             class="flex items-center gap-1 text-green-600 hover:text-green-800">
                                            <svg xmlns="http://www.w3.org/2000/svg"
         class="w-4 h-4 sm:w-5 sm:h-5"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M2.458 12C3.732 7.943 7.523 5 12 5
                 c4.477 0 8.268 2.943 9.542 7
                 -1.274 4.057-5.065 7-9.542 7
                 -4.477 0-8.268-2.943-9.542-7z" />
    </svg>
                                          <span class="hidden sm:inline">Detail</span>
                                        </a>
                                       

                                        {{-- Edit --}}
                                         <button 
                            @click="openEdit=true; editId={{ $video->id }}"
                                           class="flex items-center gap-1 text-blue-600 hover:text-blue-800">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-4 h-4 sm:w-5 sm:h-5"
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

                                            <span class="hidden sm:inline">Edit</span>
                                        </button>

                                        {{-- Hapus --}}
                                        <form action="{{ route('guru.video.destroy', $video->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin hapus materi ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="flex items-center gap-1 text-red-600 hover:text-red-800">
                                                 <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-4 h-4 sm:w-5 sm:h-5"
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
                                                <span class="hidden sm:inline">Hapus</span>
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
      action="{{ route('guru.video.store') }}"
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

<label class="block text-sm font-medium">Upload Video URL </label>
<input type="url" name="video_url"
       accept="url"
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

    @foreach($videos as $video)

 <div
        @click.away="openEdit=false"
        class="bg-white w-full max-w-xl rounded-2xl shadow-xl p-6">

        <h2 class="text-xl font-bold mb-4">Edit Materi</h2>

 <form
            action="{{ route('guru.video.update', $video->id) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            @method('PUT')




            <input type="text" name="judul"
                value="{{ $video->judul }}"
                class="w-full rounded-lg border-gray-300">

            <textarea name="deskripsi" rows="2"
                class="w-full rounded-lg border-gray-300">{{ $video->deskripsi }}</textarea>

            <textarea name="tujuan_pembelajaran" rows="2"
                class="w-full rounded-lg border-gray-300">{{ $video->tujuan_pembelajaran }}</textarea>

            <input type="url" name="video_url"
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
        </form>
    </div>
    @endforeach
</div>
</div>


</main>
</div>
</x-app-layout>
