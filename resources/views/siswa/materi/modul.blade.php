<x-app-layout>
    <div class="flex">

        @include('layouts.sidebar')

        <main class="flex-1 ml-0 lg:ml-64 p-4 sm:p-6 lg:p-8 space-y-8 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">

            <div class="max-w-7xl mx-auto space-y-8">

                {{-- ================= HERO INFO ================= --}}
                <section class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-800 p-8 sm:p-10 text-white shadow-2xl">

                    <div class="absolute top-0 right-0 w-72 h-72 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-400/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>

                    {{-- NOTIF (dipindah ke HERO) --}}
                    <div class="relative z-20 flex justify-end mb-4"
                        x-data="{ openNotif:false }">

                        @php
                        $unread = auth()->user()->notifications->where('is_read', false)->count();
                        @endphp

                        <button @click="openNotif=!openNotif"
                            class="relative p-3 rounded-2xl bg-white/10 backdrop-blur shadow border border-white/20 text-white hover:bg-white/20 transition">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11
                                   a6.002 6.002 0 00-4-5.659V5
                                   a2 2 0 10-4 0v.341
                                   C7.67 6.165 6 8.388 6 11v3.159
                                   c0 .538-.214 1.055-.595 1.436L4 17h5
                                   m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>

                            @if($unread > 0)
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                                {{ $unread }}
                            </span>
                            @endif
                        </button>

                        <div x-show="openNotif"
                            x-transition
                            @click.away="openNotif=false"
                            class="absolute right-0 mt-3 w-80 bg-white rounded-3xl shadow-2xl border border-slate-100 p-4 z-50">

                            <h4 class="font-bold text-slate-800 mb-3">Notifikasi</h4>

                            @forelse(auth()->user()->notifications->take(5) as $notif)
                            <div class="p-3 rounded-2xl hover:bg-slate-50 border-b">
                                <p class="text-sm font-semibold text-slate-800">{{ $notif->judul }}</p>
                                <p class="text-xs text-slate-500 mt-1">{{ $notif->pesan }}</p>
                                <p class="text-[10px] text-slate-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                            </div>
                            @empty
                            <p class="text-sm text-slate-400 text-center py-5">Tidak ada notifikasi</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- HERO CONTENT --}}
                    <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                        <div>
                            <p class="uppercase tracking-[3px] text-blue-200 text-xs font-semibold mb-2">
                                Mata Pelajaran
                            </p>
                            <h2 class="text-2xl sm:text-4xl font-black mb-3">
                                Algoritma dan Pemrograman
                            </h2>
                            <p class="text-blue-100 max-w-2xl text-sm sm:text-base">
                                Akses seluruh materi pembelajaran, video penjelasan, file pendukung, serta forum diskusi untuk memperdalam pemahamanmu.
                            </p>
                        </div>

                        <div class="bg-white/10 backdrop-blur rounded-3xl px-6 py-5 border border-white/10">
                            <p class="text-xs uppercase text-blue-200 font-semibold">Total Materi</p>
                            <p class="text-3xl font-black mt-1">{{ $moduls->count() }}</p>
                        </div>
                    </div>
                </section>

                {{-- ================= GRID MATERI ================= --}}
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

                    @forelse($moduls as $modul)

                    <div class="bg-white/95 backdrop-blur rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-2xl hover:-translate-y-1 transition duration-300 p-6 sm:p-7">

                        {{-- HEADER --}}
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center shrink-0">
                                📘
                            </div>

                            <div class="flex-1">
                                <p class="text-xs uppercase tracking-[2px] text-blue-500 font-semibold">
                                    Materi {{ $loop->iteration }}
                                </p>
                                <h3 class="text-lg font-bold text-slate-800 mt-1 leading-snug">
                                    {{ $modul->judul }}
                                </h3>
                            </div>
                        </div>

                        {{-- TUJUAN --}}
                        @if($modul->tujuan_pembelajaran)
                        <div class="mt-5 bg-blue-50 border border-blue-100 rounded-2xl p-4">
                            <p class="text-[11px] uppercase tracking-wide font-bold text-blue-700 mb-1">
                                Tujuan Pembelajaran
                            </p>
                            <p class="text-sm text-blue-600 leading-relaxed">
                                {{ $modul->tujuan_pembelajaran }}
                            </p>
                        </div>
                        @endif

                        {{-- DESKRIPSI --}}
                        @if($modul->deskripsi)
                        <p class="mt-4 text-sm text-slate-500 leading-relaxed">
                            {{ $modul->deskripsi }}
                        </p>
                        @endif

                        {{-- ACTION --}}
                        <div class="flex flex-wrap gap-3 mt-5">

                            @if($modul->file_materi)
                            <a href="{{ asset('storage/' . $modul->file_materi) }}" target="_blank"
                                class="px-4 py-2 rounded-xl bg-slate-100 text-slate-700 text-xs font-semibold hover:bg-slate-200 transition">
                                👁️ Lihat File
                            </a>

                            <a href="{{ route('siswa.modul.download', $modul->id) }}"
                                class="px-4 py-2 rounded-xl bg-blue-600 text-white text-xs font-semibold hover:bg-blue-700 transition shadow">
                                ⬇ Download
                            </a>
                            @endif
                        </div>

                        {{-- VIDEO (KEMBALI NORMAL) --}}
                        @if($modul->video_url)
                        @php
                        $video = $modul->video_url;
                        if(str_contains($video,'youtu.be')){
                        $video = str_replace('youtu.be/','www.youtube.com/embed/',explode('?',$video)[0]);
                        } else {
                        $video = str_replace('watch?v=','embed/',$video);
                        }
                        @endphp

                        <div x-data="{ showVideo:false }" class="mt-5">
                            <button @click="showVideo=!showVideo"
                                class="text-sm font-semibold text-blue-600 hover:text-blue-700 transition">
                                ▶ <span x-text="showVideo ? 'Sembunyikan Video' : 'Preview Video Pembelajaran'"></span>
                            </button>

                            <div x-show="showVideo" x-transition class="mt-3 rounded-2xl overflow-hidden border aspect-video">
                                <iframe src="{{ $video }}" class="w-full h-full" allowfullscreen></iframe>
                            </div>
                        </div>
                        @endif

                        {{-- DISKUSI (KEMBALI NORMAL) --}}
                        <div class="mt-6 pt-5 border-t" x-data="{ replyId:null }">

                            <h4 class="font-bold text-slate-700 mb-3">Diskusi Materi</h4>

                            <form action="{{ route('komentar.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="modul_id" value="{{ $modul->id }}">

                                <textarea name="isi" rows="2" required
                                    placeholder="Tulis komentar atau pertanyaan..."
                                    class="w-full rounded-2xl border-slate-200 text-sm focus:ring-blue-300"></textarea>

                                <button class="mt-2 px-4 py-2 rounded-xl bg-blue-600 text-white text-xs font-semibold hover:bg-blue-700">
                                    Kirim Komentar
                                </button>
                            </form>

                            <div class="mt-4 space-y-3 max-h-64 overflow-y-auto pr-2">
                                @forelse($modul->comments->where('parent_id', null) as $komen)

                                <div class="bg-slate-50 rounded-2xl p-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-semibold text-slate-700">{{ $komen->user->name }}</span>
                                        <span class="text-[10px] {{ $komen->user->role == 'guru' ? 'text-blue-600' : 'text-slate-400' }}">
                                            {{ $komen->user->role }}
                                        </span>
                                    </div>

                                    <p class="text-sm text-slate-600 mt-1">{{ $komen->isi }}</p>

                                    <button @click="replyId={{ $komen->id }}"
                                        class="text-[11px] text-blue-500 mt-2">
                                        Balas
                                    </button>

                                    <div x-show="replyId === {{ $komen->id }}" class="mt-2">
                                        <form action="{{ route('komentar.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="modul_id" value="{{ $modul->id }}">
                                            <input type="hidden" name="parent_id" value="{{ $komen->id }}">
                                            <textarea name="isi" rows="2" class="w-full rounded-xl border-slate-200 text-xs"></textarea>
                                            <button class="mt-1 px-3 py-1 bg-blue-500 text-white rounded-lg text-[10px]">
                                                Kirim Balasan
                                            </button>
                                        </form>
                                    </div>

                                    <div class="ml-4 mt-3 space-y-2">
                                        @foreach($komen->replies as $reply)
                                        <div class="bg-white border rounded-xl p-2 text-xs">
                                            <b>{{ $reply->user->name }}</b> : {{ $reply->isi }}
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                @empty
                                <p class="text-xs text-slate-400">Belum ada diskusi</p>
                                @endforelse
                            </div>
                        </div>

                    </div>

                    @empty
                    <div class="col-span-full bg-white rounded-[2rem] p-12 text-center shadow border">
                        <div class="text-5xl mb-4">📂</div>
                        <h3 class="text-xl font-bold text-slate-700">Belum Ada Materi</h3>
                        <p class="text-slate-400 mt-2">Materi akan tampil ketika guru menambahkan modul pembelajaran.</p>
                    </div>
                    @endforelse

                </div>

                {{-- BACK --}}
                <div class="flex justify-end">
                    <a href="{{ url()->previous() }}"
                        class="px-5 py-2.5 rounded-full bg-white border border-slate-300 text-slate-600 hover:bg-slate-50 transition text-sm font-semibold">
                        Kembali
                    </a>
                </div>

            </div>
        </main>

</x-app-layout>