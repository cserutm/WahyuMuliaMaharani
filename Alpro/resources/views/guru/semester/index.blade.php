<x-app-layout>

    <div class="flex">

        @include('guru.sidebar')

        <main class="flex-1 ml-0 lg:ml-64 p-4 sm:p-6 lg:p-8 space-y-8"
            x-data="{ open:false, openEdit:false, editId:null }">

            {{-- ================= HEADER HERO ================= --}}
            <section class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-800 p-6 sm:p-8 text-white shadow-2xl mb-8">
                <div class="absolute top-0 right-0 w-72 h-72 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-400/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <p class="uppercase tracking-[3px] text-blue-200 text-xs font-semibold mb-2">
                            Dashboard Pengaturan Akademik
                        </p>
                        <h1 class="text-2xl sm:text-4xl font-black mb-3">
                            Manajemen Semester 📚
                        </h1>
                        <p class="text-blue-100 max-w-2xl text-sm sm:text-base">
                            Kelola semester aktif, tahun ajaran, dan pengaturan periode pembelajaran dengan mudah.
                        </p>
                    </div>

                    <button
                        @click="open=true"
                        class="inline-flex items-center gap-2 px-5 py-3 bg-white/10 backdrop-blur-md border border-white/20 text-white rounded-2xl hover:bg-white/20 transition shadow-lg">

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

                        Tambah Semester
                    </button>
                </div>
            </section>


            {{-- ================= STATISTIK ================= --}}
            <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">

                <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <p class="text-sm text-slate-400">Total Semester</p>
                    <h2 class="text-4xl font-black text-blue-900 mt-3">
                        {{ $semesters->count() }}
                    </h2>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <p class="text-sm text-slate-400">Semester Ganjil</p>
                    <h2 class="text-4xl font-black text-indigo-700 mt-3">
                        {{ $semesters->where('nama_semester','Ganjil')->count() }}
                    </h2>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <p class="text-sm text-slate-400">Semester Genap</p>
                    <h2 class="text-4xl font-black text-emerald-600 mt-3">
                        {{ $semesters->where('nama_semester','Genap')->count() }}
                    </h2>
                </div>

            </section>


            {{-- ================= TABLE ================= --}}
            <section class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">

                <div class="px-6 py-5 border-b bg-slate-50">
                    <h3 class="text-lg font-bold text-slate-800">Daftar Semester Aktif Sistem</h3>
                    <p class="text-sm text-slate-500 mt-1">Kelola semester ganjil dan genap yang tersedia.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm min-w-[700px]">

                        <thead class="bg-slate-100 border-b text-slate-600 uppercase tracking-wider text-xs">
                            <tr>
                                <th class="px-6 py-4 text-left">No</th>
                                <th class="px-6 py-4 text-left">Semester</th>
                                <th class="px-6 py-4 text-left">Tahun Ajaran</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-200">

                            @forelse($semesters as $semester)
                            <tr class="hover:bg-blue-50/40 transition">

                                <td class="px-6 py-4 text-slate-500">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 font-semibold text-slate-800">
                                    {{ $semester->nama_semester }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $semester->tahun_ajaran }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if($semester->is_active)
                                    <span class="px-4 py-1.5 text-xs font-bold bg-emerald-100 text-emerald-700 rounded-full">
                                        Aktif
                                    </span>
                                    @else
                                    <span class="px-4 py-1.5 text-xs font-bold bg-slate-100 text-slate-500 rounded-full">
                                        Nonaktif
                                    </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-3">

                                        @if(!$semester->is_active)
                                        <form action="{{ route('guru.semester.activate',$semester->id) }}" method="POST">
                                            @csrf
                                            <button title="Aktifkan Semester"
                                                class="p-2 rounded-xl bg-green-50 text-green-600 hover:bg-green-100 transition shadow-sm">

                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-5 h-5"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor">

                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M5 13l4 4L19 7" />

                                                </svg>
                                            </button>
                                        </form>
                                        @else
                                        <form action="{{ route('guru.semester.deactivate',$semester->id) }}" method="POST">
                                            @csrf
                                            <button title="Nonaktifkan Semester"
                                                class="p-2 rounded-xl bg-yellow-50 text-yellow-600 hover:bg-yellow-100 transition shadow-sm">

                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-5 h-5"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor">

                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />

                                                </svg>
                                            </button>
                                        </form>
                                        @endif

                                        <button
                                            @click="openEdit=true; editId={{ $semester->id }}"
                                            class="p-2 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-100 transition shadow-sm">

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

                                        <form action="{{ route('guru.semester.destroy',$semester->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin hapus semester ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="p-2 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 transition shadow-sm">

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
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-12 text-slate-400">
                                    Belum ada data semester
                                </td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </section>

            {{-- MODAL TAMBAH --}}
            <div x-cloak x-show="open" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
                <div @click.away="open=false" class="bg-white w-full max-w-md rounded-3xl shadow-2xl p-6 sm:p-8">
                    <h2 class="text-xl font-black text-blue-900 mb-5">Tambah Semester</h2>

                    <form action="{{ route('guru.semester.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-semibold mb-2">Nama Semester</label>
                            <select name="nama_semester" class="w-full rounded-xl border-slate-300">
                                <option value="">Pilih Semester</option>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" placeholder="2024/2025" class="w-full rounded-xl border-slate-300">
                        </div>

                        <div class="flex justify-end gap-3 pt-2">
                            <button type="button" @click="open=false" class="px-4 py-2 border rounded-xl">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded-xl hover:bg-blue-800">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- MODAL EDIT --}}
            @foreach($semesters as $semester)
            <div x-cloak x-show="openEdit && editId == {{ $semester->id }}" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
                <div @click.away="openEdit=false" class="bg-white w-full max-w-md rounded-3xl shadow-2xl p-6 sm:p-8">
                    <h2 class="text-xl font-black text-blue-900 mb-5">Edit Semester</h2>

                    <form action="{{ route('guru.semester.update',$semester->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-semibold mb-2">Nama Semester</label>
                            <select name="nama_semester" class="w-full rounded-xl border-slate-300">
                                <option value="Ganjil" {{ $semester->nama_semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                                <option value="Genap" {{ $semester->nama_semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" value="{{ $semester->tahun_ajaran }}" class="w-full rounded-xl border-slate-300">
                        </div>

                        <div class="flex justify-end gap-3 pt-2">
                            <button type="button" @click="openEdit=false" class="px-4 py-2 border rounded-xl">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded-xl hover:bg-blue-800">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach

        </main>
    </div>

</x-app-layout>