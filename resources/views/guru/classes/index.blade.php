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
                            Dashboard Pengelolaan Akademik
                        </p>

                        <h1 class="text-2xl sm:text-4xl font-black mb-3">
                            Manajemen Kelas 🏫
                        </h1>

                        <p class="text-blue-100 max-w-2xl text-sm sm:text-base">
                            Kelola data kelas pembelajaran berdasarkan semester aktif dan tahun ajaran yang berjalan.
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

                        Tambah Kelas
                    </button>
                </div>
            </section>


            {{-- ================= STATISTIK ================= --}}
            <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">

                <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <p class="text-sm text-slate-400">Total Kelas</p>
                    <h2 class="text-4xl font-black text-blue-900 mt-3">
                        {{ $classes->count() }}
                    </h2>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <p class="text-sm text-slate-400">Semester Ganjil</p>
                    <h2 class="text-4xl font-black text-indigo-700 mt-3">
                        {{ $classes->where('semester.nama_semester','Ganjil')->count() }}
                    </h2>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <p class="text-sm text-slate-400">Semester Genap</p>
                    <h2 class="text-4xl font-black text-emerald-600 mt-3">
                        {{ $classes->where('semester.nama_semester','Genap')->count() }}
                    </h2>
                </div>

            </section>


            {{-- ================= TABLE ================= --}}
            <section class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">

                <div class="px-6 py-5 border-b bg-slate-50">
                    <h3 class="text-lg font-bold text-slate-800">Daftar Kelas Pembelajaran</h3>
                    <p class="text-sm text-slate-500 mt-1">Kelola seluruh kelas berdasarkan semester aktif.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm min-w-[700px]">

                        <thead class="bg-slate-100 border-b">
                            <tr class="text-slate-600 uppercase tracking-wider text-xs">
                                <th class="px-6 py-4 text-left">No</th>
                                <th class="px-6 py-4 text-left">Nama Kelas</th>
                                <th class="px-6 py-4 text-left">Semester</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-200">

                            @foreach($classes as $class)

                            <tr class="hover:bg-blue-50/40 transition">

                                <td class="px-6 py-4 text-slate-500">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 font-semibold text-slate-800">
                                    {{ $class->nama_kelas }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $class->semester->nama_semester }} - {{ $class->semester->tahun_ajaran }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-3">

                                        {{-- EDIT --}}
                                        <button
                                            @click="openEdit=true; editId={{ $class->id }}"
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

                                        {{-- DELETE --}}
                                        <form action="{{ route('guru.classes.destroy',$class->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Hapus kelas ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="p-2 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 transition shadow-sm">

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


            {{-- MODAL TAMBAH --}}
            <div
                x-cloak
                x-show="open"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">

                <div
                    @click.away="open=false"
                    class="bg-white w-full max-w-md rounded-3xl shadow-2xl p-6 sm:p-8">

                    <h2 class="text-xl font-black text-blue-900 mb-5">
                        Tambah Kelas
                    </h2>

                    <form action="{{ route('guru.classes.store') }}"
                        method="POST"
                        class="space-y-4">

                        @csrf

                        <input type="text"
                            name="nama_kelas"
                            placeholder="Nama Kelas"
                            class="w-full rounded-xl border-slate-300">

                        <select name="semester_id"
                            class="w-full rounded-xl border-slate-300">

                            @foreach($semesters as $semester)

                            <option value="{{ $semester->id }}">
                                {{ $semester->nama_semester }} - {{ $semester->tahun_ajaran }}
                            </option>

                            @endforeach

                        </select>

                        <div class="flex justify-end gap-3">
                            <button type="button"
                                @click="open=false"
                                class="px-4 py-2 border rounded-xl">
                                Batal
                            </button>

                            <button type="submit"
                                class="px-4 py-2 bg-blue-700 text-white rounded-xl hover:bg-blue-800">
                                Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>


            {{-- MODAL EDIT --}}
            @foreach($classes as $class)

            <div
                x-cloak
                x-show="openEdit && editId == {{ $class->id }}"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">

                <div
                    @click.away="openEdit=false"
                    class="bg-white w-full max-w-md rounded-3xl shadow-2xl p-6 sm:p-8">

                    <h2 class="text-xl font-black text-blue-900 mb-5">
                        Edit Kelas
                    </h2>

                    <form
                        action="{{ route('guru.classes.update',$class->id) }}"
                        method="POST"
                        class="space-y-4">

                        @csrf
                        @method('PUT')

                        <input type="text"
                            name="nama_kelas"
                            value="{{ $class->nama_kelas }}"
                            class="w-full rounded-xl border-slate-300">

                        <select name="semester_id"
                            class="w-full rounded-xl border-slate-300">

                            @foreach($semesters as $semester)

                            <option value="{{ $semester->id }}"
                                {{ $class->semester_id == $semester->id ? 'selected' : '' }}>

                                {{ $semester->nama_semester }} - {{ $semester->tahun_ajaran }}

                            </option>

                            @endforeach

                        </select>

                        <div class="flex justify-end gap-3">

                            <button type="button"
                                @click="openEdit=false"
                                class="px-4 py-2 border rounded-xl">
                                Batal
                            </button>

                            <button type="submit"
                                class="px-4 py-2 bg-blue-700 text-white rounded-xl hover:bg-blue-800">
                                Update
                            </button>

                        </div>

                    </form>

                </div>

            </div>

            @endforeach

        </main>
    </div>

</x-app-layout>