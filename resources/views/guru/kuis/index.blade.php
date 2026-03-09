<x-app-layout>

<div class="flex">

@include('guru.sidebar')

<main class="flex-1 ml-64 p-10"
      x-data="{ open:false, openEdit:false, editId:null }">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Manajemen Kuis
            </h1>
            <p class="text-sm text-gray-500">
                Kelola evaluasi pembelajaran siswa
            </p>
        </div>

        {{-- BUTTON TAMBAH --}}
        <button
            @click="open=true; $nextTick(() => $refs.form.reset())"
            class="inline-flex items-center gap-2
                   px-4 py-2
                   bg-white border border-blue-200
                   text-blue-600
                   rounded-xl shadow-sm
                   hover:bg-blue-50 transition">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 4v16m8-8H4"/>
            </svg>

            Tambah Kuis
        </button>
    </div>

    {{-- STATISTIK CARD --}}
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8">

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-sm text-gray-500">Total Kuis</p>
            <p class="text-2xl font-bold text-gray-800">
                {{ $kuis->count() }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-sm text-gray-500">Aktif</p>
            <p class="text-2xl font-bold text-green-600">
                {{ $kuis->where('status','aktif')->count() }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-sm text-gray-500">Draft</p>
            <p class="text-2xl font-bold text-yellow-500">
                {{ $kuis->where('status','draft')->count() }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 border border-red-100">
            <p class="text-sm text-gray-500">Nonaktif</p>
            <p class="text-2xl font-bold text-red-600">
                {{ $kuis->where('status','nonaktif')->count() }}
            </p>
        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 border-b">
                <tr class="text-gray-600">
                    <th class="px-6 py-4 text-left">No</th>
                    <th class="px-6 py-4 text-left">Judul</th>
                    <th class="px-6 py-4 text-left">Kelas</th>
                    <th class="px-6 py-4 text-left">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">

            @foreach($kuis as $item)
            <tr class="hover:bg-gray-50 transition">

                <td class="px-6 py-4 text-gray-500">
                    {{ $loop->iteration }}
                </td>

                <td class="px-6 py-4 font-semibold text-gray-800">
                    {{ $item->judul }}
                </td>

                <td class="px-6 py-4 text-gray-600">
                    {{ $item->class->nama_kelas ?? '-' }}
                </td>

                <td class="px-6 py-4">
                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                        {{ $item->status == 'aktif' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $item->status == 'draft' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $item->status == 'nonaktif' ? 'bg-red-100 text-red-700' : '' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>

                {{-- AKSI --}}
                <td class="px-6 py-4">
                    <div class="flex justify-center gap-3">

                        {{-- EDIT --}}
                        <button
                            @click="openEdit=true; editId={{ $item->id }}"
                            class="p-2 rounded-lg
                                   bg-blue-50 text-blue-600
                                   hover:bg-blue-100 transition">

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
                                         H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                         {{-- Kelola Soal --}}
                                    <a href="{{ route('guru.kuis.pertanyaan.index', $item->id) }}"
                                       class="p-2 rounded-lg bg-green-50 text-green-600 hover:bg-green-100 transition"
                                       title="Kelola Soal">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-5 h-5"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M9 12h6m-6 4h6M7 4h10
                                                     a2 2 0 012 2v12
                                                     a2 2 0 01-2 2H7
                                                     a2 2 0 01-2-2V6
                                                     a2 2 0 012-2z"/>
                                        </svg>
                                    </a>

                        {{-- HAPUS --}}
                        <form action="{{ route('guru.kuis.destroy', $item->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin hapus kuis ini?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="p-2 rounded-lg
                                           bg-red-50 text-red-600
                                           hover:bg-red-100 transition">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
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
            @endforeach

            </tbody>
        </table>
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

<div>
<label class="block text-sm font-medium mb-2">Pilih Kelas</label>

<div class="flex flex-col gap-2">

@foreach($classes as $class)
<label class="flex items-center gap-2">
<input type="radio" name="class_id" value="{{ $class->id }}" required>
{{ $class->nama_kelas }}
</label>
@endforeach

</div>
</div>

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

                <div>
<label class="block text-sm font-medium mb-2">Pilih Kelas</label>

@foreach($classes as $class)
<label class="flex items-center gap-2">
<input type="radio" name="class_id"
value="{{ $class->id }}"
{{ $item->class_id == $class->id ? 'checked' : '' }}>
{{ $class->nama_kelas }}
</label>
@endforeach

</div>
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
