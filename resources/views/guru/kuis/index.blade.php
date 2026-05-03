<x-app-layout>

    <div class="flex">

        @include('guru.sidebar')

        <main class="flex-1 ml-0 lg:ml-64 p-4 sm:p-6 lg:p-8 space-y-8"
            x-data="{ open:false, openEdit:false, editId:null }">

            {{-- HEADER DASHBOARD STYLE --}}
            <section class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-800 px-6 sm:px-8 py-7 shadow-xl mb-8">
                <div class="absolute right-0 top-0 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-cyan-300/10 rounded-full blur-2xl"></div>

                <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-white">
                            Manajemen Kuis
                        </h1>
                        <p class="text-blue-100 text-sm mt-1">
                            Kelola evaluasi pembelajaran siswa
                        </p>
                    </div>

                    <button
                        @click="open=true; $nextTick(() => $refs.form.reset())"
                        class="inline-flex items-center justify-center gap-2
                               px-5 py-3
                               bg-white/15 backdrop-blur-md border border-white/20
                               text-white font-medium
                               rounded-2xl shadow-lg
                               hover:bg-white/25 transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>

                        Tambah Kuis
                    </button>
                </div>
            </section>

            {{-- STATISTIK --}}
            <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

                <div class="bg-white/90 backdrop-blur-sm rounded-3xl p-6 border border-white shadow-md">
                    <p class="text-sm text-gray-500">Total Kuis</p>
                    <h2 class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $kuis->count() }}
                    </h2>
                </div>

                <div class="bg-white/90 backdrop-blur-sm rounded-3xl p-6 border border-white shadow-md">
                    <p class="text-sm text-gray-500">Aktif</p>
                    <h2 class="text-3xl font-bold text-green-600 mt-2">
                        {{ $kuis->where('status','aktif')->count() }}
                    </h2>
                </div>

                <div class="bg-white/90 backdrop-blur-sm rounded-3xl p-6 border border-white shadow-md">
                    <p class="text-sm text-gray-500">Draft</p>
                    <h2 class="text-3xl font-bold text-yellow-500 mt-2">
                        {{ $kuis->where('status','draft')->count() }}
                    </h2>
                </div>

                <div class="bg-white/90 backdrop-blur-sm rounded-3xl p-6 border border-white shadow-md">
                    <p class="text-sm text-gray-500">Nonaktif</p>
                    <h2 class="text-3xl font-bold text-red-600 mt-2">
                        {{ $kuis->where('status','nonaktif')->count() }}
                    </h2>
                </div>

            </section>

            {{-- TABLE --}}
            <section class="bg-white/95 backdrop-blur-sm rounded-[2rem] shadow-xl border border-white overflow-hidden">

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[850px] text-sm">

                        <thead class="bg-slate-50 border-b text-gray-600">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">No</th>
                                <th class="px-6 py-4 text-left font-semibold">Judul</th>
                                <th class="px-6 py-4 text-left font-semibold">Kelas</th>
                                <th class="px-6 py-4 text-left font-semibold">Status</th>
                                <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @foreach($kuis as $item)
                            <tr class="hover:bg-blue-50/40 transition">

                                <td class="px-6 py-5 text-gray-500">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-5 font-semibold text-gray-800 whitespace-nowrap">
                                    {{ $item->judul }}
                                </td>

                                <td class="px-6 py-5 text-gray-600 whitespace-nowrap">
                                    {{ $item->class->nama_kelas ?? '-' }}
                                </td>

                                <td class="px-6 py-5">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                                        {{ $item->status == 'aktif' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $item->status == 'draft' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $item->status == 'nonaktif' ? 'bg-red-100 text-red-700' : '' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>

                                <td class="px-6 py-5">
                                    <div class="flex justify-center gap-3">

                                        {{-- EDIT --}}
                                        <button
                                            @click="openEdit=true; editId={{ $item->id }}"
                                            class="p-2 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-100 transition">

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

                                        {{-- KELOLA SOAL --}}
                                        <a href="{{ route('guru.kuis.pertanyaan.index', $item->id) }}"
                                            class="p-2 rounded-xl bg-green-50 text-green-600 hover:bg-green-100 transition"
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
                                                         a2 2 0 012-2z" />
                                            </svg>
                                        </a>

                                        {{-- HAPUS --}}
                                        <form action="{{ route('guru.kuis.destroy', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin hapus kuis ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="p-2 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 transition">

                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-5 h-5"
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
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </section>

            {{-- MODAL CREATE --}}
            <div x-cloak x-show="open" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">

                <div @click.away="open = false"
                    class="bg-white w-full max-w-xl rounded-3xl shadow-2xl p-6 sm:p-8 max-h-[90vh] overflow-y-auto">

                    <h2 class="text-2xl font-bold text-gray-800 mb-5">Tambah Kuis</h2>

                    <form x-ref="form" action="{{ route('guru.kuis.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf

                        <input type="text" name="judul" required placeholder="Judul Kuis"
                            class="w-full rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                        <div>
                            <label class="block text-sm font-medium mb-2">Pilih Kelas</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                @foreach($classes as $class)
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="radio" name="class_id" value="{{ $class->id }}" required>
                                    {{ $class->nama_kelas }}
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Status</label>
                            <div class="flex flex-wrap gap-5 text-sm">
                                <label class="flex items-center gap-2"><input type="radio" name="status" value="aktif" required> Aktif</label>
                                <label class="flex items-center gap-2"><input type="radio" name="status" value="draft"> Draft</label>
                                <label class="flex items-center gap-2"><input type="radio" name="status" value="nonaktif"> Non Aktif</label>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-3">
                            <button type="button" @click="open=false" class="px-5 py-2 border rounded-xl">Batal</button>
                            <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- MODAL EDIT --}}
            @foreach($kuis as $item)
            <div x-cloak x-show="openEdit && editId == {{ $item->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">

                <div @click.away="openEdit=false"
                    class="bg-white w-full max-w-xl rounded-3xl shadow-2xl p-6 sm:p-8 max-h-[90vh] overflow-y-auto">

                    <h2 class="text-2xl font-bold text-gray-800 mb-5">Edit Kuis</h2>

                    <form action="{{ route('guru.kuis.update', $item->id) }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <input type="text" name="judul" value="{{ $item->judul }}"
                            class="w-full rounded-xl border-gray-300">

                        <div>
                            <label class="block text-sm font-medium mb-2">Pilih Kelas</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                @foreach($classes as $class)
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="radio" name="class_id" value="{{ $class->id }}" {{ $item->class_id == $class->id ? 'checked' : '' }}>
                                    {{ $class->nama_kelas }}
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Status</label>
                            <div class="flex flex-wrap gap-5 text-sm">
                                <label><input type="radio" name="status" value="aktif" {{ $item->status == 'aktif' ? 'checked' : '' }}> Aktif</label>
                                <label><input type="radio" name="status" value="draft" {{ $item->status == 'draft' ? 'checked' : '' }}> Draft</label>
                                <label><input type="radio" name="status" value="nonaktif" {{ $item->status == 'nonaktif' ? 'checked' : '' }}> Non Aktif</label>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-3">
                            <button type="button" @click="openEdit=false" class="px-5 py-2 border rounded-xl">Batal</button>
                            <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach

        </main>
    </div>

</x-app-layout>