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
        editId:null
    }">


    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kelola Kuis</h1>

        {{-- Tombol Tambah --}}
        
                <button
           @click="open = true; tipe = ''; $nextTick(() => $refs.form.reset())"

            class="inline-flex items-center gap-2 px-3 py-1 bg-blue-600 text-white rounded-lg">
             <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4" />
                    </svg>
             Tambah Kuis
                </button>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                 <tr class="border-b text-gray-600">
                    <th class="px-6 py-3 text-left">No</th>
                    <th class="px-6 py-3 text-left">Judul</th>
                    <th class="px-6 py-3 text-left">Kelas</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse ($kuis as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3">{{ $item->id }}</td>
                        <td class="px-6 py-3 font-medium">{{ $item->judul }}</td>
                        <td class="px-6 py-3 text-gray-600">{{ $item->kelas}}</td>
                       <td class="px-6 py-3">
    <span class="
        px-2 py-1 rounded-full text-xs font-semibold
        {{ $item->status == 'aktif' ? 'bg-green-100 text-green-700' : '' }}
        {{ $item->status == 'draft' ? 'bg-yellow-100 text-yellow-700' : '' }}
        {{ $item->status == 'nonaktif' ? 'bg-red-100 text-red-700' : '' }}
    ">
        {{ ucfirst($item->status) }}
    </span>
</td>


                        {{-- Aksi --}}
                            <td class="px-4 py-3">
    <div class="flex justify-center items-center gap-3
                sm:gap-4
                text-sm">

            

        {{-- Edit --}}
                                         <button 
                            @click="openEdit=true; editId={{ $item->id }}"
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

                                             {{-- Kelola Soal --}}

                <a href="{{ route('guru.kuis.pertanyaan.index', $item->id) }}"
   class="flex items-center gap-1 text-green-600 hover:text-green-800">
   <svg xmlns="http://www.w3.org/2000/svg"
     fill="none"
     viewBox="0 0 24 24"
     stroke-width="1.5"
     stroke="currentColor"
     class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M7 3h7l5 5v13a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M14 3v5h5" />
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M9 14l2 2 4-4" />
</svg>
     <span class="hidden sm:inline">Kelola Soal</span>
</a>


        {{-- Hapus --}}
        <form action="{{ route('guru.kuis.destroy', $item->id) }}"
              method="POST"
              onsubmit="return confirm('Yakin hapus kuis ini?')">
            @csrf
            @method('DELETE')

            <button type="submit"
                class="flex items-center gap-1 text-red-600 hover:text-red-800 transition"
                title="Hapus Kuis">

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
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            Belum ada kuis
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

        <h2 class="text-xl font-bold mb-4">Tambah Kuis</h2>
        <form x-ref="form"
      action="{{ route('guru.kuis.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="space-y-4">
@csrf

<input type="text" name="judul" required
       placeholder="Judul Kuis"
       class="w-full rounded-lg border-gray-300">

<textarea name="kelas" rows="2"
          class="w-full rounded-lg border-gray-300"
          placeholder="kelas"></textarea>

<div>
    <label class="block text-sm font-medium mb-2">Status</label>

    <div class="flex gap-6">
        <label class="flex items-center gap-2">
            <input type="radio" name="status" value="aktif" required>
            Aktif
        </label>

        <label class="flex items-center gap-2">
            <input type="radio" name="status" value="draft">
            Draft
        </label>

        <label class="flex items-center gap-2">
            <input type="radio" name="status" value="nonaktif">
            Non Aktif
        </label>
    </div>
</div>

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
@foreach($kuis as $item)
<div
    x-cloak
    x-show="openEdit && editId == {{ $item->id }}"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">

    <div
        @click.away="openEdit=false"
        class="bg-white w-full max-w-xl rounded-2xl shadow-xl p-6">

        <h2 class="text-xl font-bold mb-4">Edit Kuis</h2>

        <form
            action="{{ route('guru.kuis.update', $item->id) }}"
            method="POST"
            class="space-y-4">
            @csrf
            @method('PUT')

            <input type="text" name="judul"
                value="{{ $item->judul }}"
                class="w-full rounded-lg border-gray-300">

            <textarea name="kelas" rows="2"
                class="w-full rounded-lg border-gray-300">{{ $item->kelas }}</textarea>

            <div>
                <label class="block text-sm font-medium mb-2">Status</label>

                <div class="flex gap-6">
                    <label>
                        <input type="radio" name="status" value="aktif"
                        {{ $item->status == 'aktif' ? 'checked' : '' }}>
                        Aktif
                    </label>

                    <label>
                        <input type="radio" name="status" value="draft"
                        {{ $item->status == 'draft' ? 'checked' : '' }}>
                        Draft
                    </label>

                    <label>
                        <input type="radio" name="status" value="nonaktif"
                        {{ $item->status == 'nonaktif' ? 'checked' : '' }}>
                        Non Aktif
                    </label>
                </div>
            </div>

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
</div>
@endforeach
    </div>
</main>
</div>
</x-app-layout>
