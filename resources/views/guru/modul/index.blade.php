<x-app-layout>

      <div class="flex">

            @include('guru.sidebar')

            <main class="flex-1 ml-0 lg:ml-64 p-4 sm:p-6 lg:p-8 space-y-8"
                  x-data="{ open:false, openEdit:false, editId:null }">

                  {{-- HEADER --}}
                  <section class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-800 p-6 sm:p-8 text-white shadow-2xl">
                        <div class="absolute top-0 right-0 w-72 h-72 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                        <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-400/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>

                        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                              <div>
                                    <p class="uppercase tracking-[3px] text-blue-200 text-xs font-semibold mb-2">
                                          Materi
                                    </p>
                                    <h1 class="text-2xl sm:text-4xl font-black mb-2">
                                          Kelola Materi📚
                                    </h1>
                                    <p class="text-blue-100 text-sm sm:text-base max-w-2xl">
                                          Kelola dan atur materi pembelajaran siswa secara terstruktur berdasarkan kelas aktif.
                                    </p>
                              </div>

                              <button
                                    @click="open = true; $nextTick(() => $refs.form?.reset())"
                                    class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-white text-blue-700 rounded-2xl font-semibold shadow-lg hover:scale-105 transition">

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

                                    <span>Tambah Materi</span>
                              </button>
                        </div>
                  </section>

                  {{-- STATISTIK --}}
                  <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

                        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 hover:shadow-xl transition">
                              <div class="flex justify-between items-center">
                                    <div>
                                          <p class="text-sm text-slate-400">Total Materi</p>
                                          <h2 class="text-4xl font-black text-blue-900 mt-2">{{ $modul->count() }}</h2>
                                    </div>
                                    <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-2xl">📄</div>
                              </div>
                        </div>

                        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 hover:shadow-xl transition">
                              <div class="flex justify-between items-center">
                                    <div>
                                          <p class="text-sm text-slate-400">Total Kelas</p>
                                          <h2 class="text-4xl font-black text-indigo-900 mt-2">{{ $classes->count() }}</h2>
                                    </div>
                                    <div class="w-14 h-14 rounded-2xl bg-indigo-100 flex items-center justify-center text-2xl">🏫</div>
                              </div>
                        </div>

                        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 hover:shadow-xl transition">
                              <div class="flex justify-between items-center">
                                    <div>
                                          <p class="text-sm text-slate-400">Materi Video</p>
                                          <h2 class="text-4xl font-black text-emerald-700 mt-2">{{ $modul->whereNotNull('video_url')->count() }}</h2>
                                    </div>
                                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-2xl">🎥</div>
                              </div>
                        </div>

                  </section>

                  {{-- TABLE --}}
                  <section class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

                        <div class="px-6 py-5 border-b bg-slate-50">
                              <h3 class="font-bold text-slate-800 text-lg">Daftar Materi Pembelajaran</h3>
                        </div>

                        <div class="overflow-x-auto">
                              <table class="w-full min-w-[850px] text-sm">

                                    <thead class="bg-slate-50">
                                          <tr class="text-slate-600">
                                                <th class="px-6 py-4 text-left">No</th>
                                                <th class="px-6 py-4 text-left">Kelas</th>
                                                <th class="px-6 py-4 text-left">Judul</th>
                                                <th class="px-6 py-4 text-left">Deskripsi</th>
                                                <th class="px-6 py-4 text-center">Aksi</th>
                                          </tr>
                                    </thead>

                                    <tbody class="divide-y divide-slate-100">

                                          @forelse ($modul as $item)
                                          <tr class="hover:bg-blue-50/40 transition">

                                                <td class="px-6 py-4 text-slate-500">{{ $loop->iteration }}</td>

                                                <td class="px-6 py-4 text-slate-700 font-medium">
                                                      {{ $item->kelas->nama_kelas ?? '-' }}
                                                </td>

                                                <td class="px-6 py-4 font-semibold text-slate-800">
                                                      {{ $item->judul }}
                                                </td>

                                                <td class="px-6 py-4 text-slate-600">
                                                      {{ $item->deskripsi }}
                                                </td>

                                                <td class="px-6 py-4">
                                                      <div class="flex justify-center items-center gap-3">

                                                            {{-- DETAIL --}}
                                                            <a href="{{ route('guru.modul.show', $item->id) }}"
                                                                  class="p-2 rounded-xl bg-green-50 text-green-600 hover:bg-green-100 transition shadow-sm">

                                                                  <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="w-4 h-4"
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
                                                            </a>

                                                            {{-- EDIT --}}
                                                            <button
                                                                  @click="openEdit=true; editId={{ $item->id }}"
                                                                  class="p-2 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-100 transition shadow-sm">

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
                                                            <form action="{{ route('guru.modul.destroy', $item->id) }}"
                                                                  method="POST"
                                                                  onsubmit="return confirm('Yakin hapus materi ini?')">
                                                                  @csrf
                                                                  @method('DELETE')

                                                                  <button type="submit"
                                                                        class="p-2 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 transition shadow-sm">

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
                                                <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                                      Belum ada materi
                                                </td>
                                          </tr>
                                          @endforelse

                                    </tbody>
                              </table>
                        </div>
                  </section>

                  {{-- MODAL CREATE --}}
                  <div x-cloak x-show="open"
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">

                        <div @click.away="open = false"
                              class="bg-white w-full max-w-xl rounded-3xl shadow-2xl p-6 max-h-[90vh] overflow-y-auto">

                              <h2 class="text-2xl font-black text-blue-900 mb-5">Tambah Materi</h2>

                              <form x-ref="form"
                                    action="{{ route('guru.modul.store') }}"
                                    method="POST"
                                    enctype="multipart/form-data"
                                    class="space-y-4">
                                    @csrf

                                    <select name="class_id" required class="w-full rounded-xl border-slate-300">
                                          <option value="">Pilih Kelas</option>
                                          @foreach($classes as $class)
                                          <option value="{{ $class->id }}">{{ $class->nama_kelas }}</option>
                                          @endforeach
                                    </select>

                                    <input type="text" name="judul" required placeholder="Judul Materi"
                                          class="w-full rounded-xl border-slate-300">

                                    <textarea name="tujuan_pembelajaran" rows="2" class="w-full rounded-xl border-slate-300"
                                          placeholder="Tujuan Pembelajaran"></textarea>

                                    <textarea name="deskripsi" rows="2" class="w-full rounded-xl border-slate-300"
                                          placeholder="Deskripsi"></textarea>

                                    <input type="file" name="file_materi" accept=".pdf,.doc,.docx" class="w-full">

                                    <input type="url" name="video_url"
                                          placeholder="https://youtube.com/..."
                                          class="w-full rounded-xl border-slate-300">

                                    <div class="flex justify-end gap-3 pt-2">
                                          <button type="button" @click="open=false"
                                                class="px-4 py-2 border rounded-xl">Batal</button>
                                          <button type="submit"
                                                class="px-5 py-2 bg-blue-700 text-white rounded-xl hover:bg-blue-800">Simpan</button>
                                    </div>
                              </form>
                        </div>
                  </div>

                  {{-- MODAL EDIT tetap logic lama --}}
                  <div x-cloak x-show="openEdit"
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">

                        <div @click.away="openEdit = false"
                              class="bg-white w-full max-w-xl rounded-3xl shadow-2xl p-6 max-h-[90vh] overflow-y-auto">

                              <h2 class="text-2xl font-black text-blue-900 mb-5">Edit Materi</h2>

                              @foreach ($modul as $item)
                              <div x-show="editId === {{ $item->id }}">
                                    <form action="{{ route('guru.modul.update', $item->id) }}"
                                          method="POST"
                                          enctype="multipart/form-data"
                                          class="space-y-4">
                                          @csrf
                                          @method('PUT')

                                          <select name="class_id" class="w-full rounded-xl border-slate-300">
                                                @foreach($classes as $class)
                                                <option value="{{ $class->id }}"
                                                      {{ $item->class_id == $class->id ? 'selected' : '' }}>
                                                      {{ $class->nama_kelas }}
                                                </option>
                                                @endforeach
                                          </select>

                                          <input type="text" name="judul" value="{{ $item->judul }}"
                                                class="w-full rounded-xl border-slate-300">

                                          <textarea name="tujuan_pembelajaran"
                                                class="w-full rounded-xl border-slate-300">{{ $item->tujuan_pembelajaran }}</textarea>

                                          <textarea name="deskripsi"
                                                class="w-full rounded-xl border-slate-300">{{ $item->deskripsi }}</textarea>

                                          <input type="file" name="file_materi" class="w-full">

                                          <input type="url" name="video_url" value="{{ $item->video_url }}"
                                                class="w-full rounded-xl border-slate-300">

                                          <div class="flex justify-end gap-3 pt-2">
                                                <button type="button" @click="openEdit=false"
                                                      class="px-4 py-2 border rounded-xl">Batal</button>
                                                <button type="submit"
                                                      class="px-5 py-2 bg-blue-700 text-white rounded-xl hover:bg-blue-800">Update</button>
                                          </div>
                                    </form>
                              </div>
                              @endforeach
                        </div>
                  </div>

            </main>
      </div>

</x-app-layout>