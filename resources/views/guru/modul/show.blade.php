<x-app-layout>

    <div class="flex">

        {{-- Sidebar --}}
        @include('guru.sidebar')

        {{-- Konten --}}
        <main class="flex-1 ml-0 lg:ml-64 p-4 sm:p-6 lg:p-8 space-y-8">

            <div class="max-w-5xl mx-auto space-y-8">

                {{-- HERO HEADER --}}
                <section class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-800 p-6 sm:p-8 text-white shadow-2xl">
                    <div class="absolute top-0 right-0 w-72 h-72 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-400/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>

                    <div class="relative z-10">
                        <p class="uppercase tracking-[3px] text-blue-200 text-xs font-semibold mb-2">
                            Detail Materi Pembelajaran
                        </p>

                        <h1 class="text-2xl sm:text-4xl font-black leading-tight">
                            {{ $modul->judul }}
                        </h1>

                        <p class="text-blue-100 mt-3 text-sm sm:text-base">
                            Dibuat pada {{ $modul->created_at->format('d M Y H:i') }}
                        </p>
                    </div>
                </section>

                {{-- DETAIL CARD --}}
                <section class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 sm:p-8 space-y-8">

                    {{-- TUJUAN --}}
                    <div class="bg-blue-50 rounded-2xl p-6">
                        <h3 class="font-bold text-blue-900 mb-3 text-lg">
                            🎯 Tujuan Pembelajaran
                        </h3>
                        <p class="text-slate-700 leading-relaxed">
                            {{ $modul->tujuan_pembelajaran }}
                        </p>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="bg-slate-50 rounded-2xl p-6">
                        <h3 class="font-bold text-slate-800 mb-3 text-lg">
                            Deskripsi Materi
                        </h3>
                        <p class="text-slate-700 leading-relaxed">
                            {{ $modul->deskripsi }}
                        </p>
                    </div>

                    {{-- FILE --}}
                    <div>

                        @if($modul->file_materi)
                        <div class="flex flex-wrap gap-3">

                            <a href="{{ asset('storage/' . $modul->file_materi) }}"
                                target="_blank"
                                class="inline-flex items-center gap-2 px-5 py-3 bg-slate-100 text-slate-700 rounded-2xl hover:bg-slate-200 transition font-medium">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5
                                        c4.477 0 8.268 2.943 9.542 7
                                        -1.274 4.057-5.065 7-9.542 7
                                        -4.477 0-8.268-2.943-9.542-7z" />
                                </svg>

                                Lihat File
                            </a>

                            <a href="{{ route('guru.modul.download', $modul->id) }}"
                                class="inline-flex items-center gap-2 px-5 py-3 bg-blue-700 text-white rounded-2xl hover:bg-blue-800 transition font-medium shadow">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 4v10m0 0l-3-3m3 3l3-3" />
                                </svg>

                                Download File
                            </a>
                        </div>
                        @else
                        <div class="bg-slate-50 rounded-2xl p-5 text-slate-400">
                            Tidak ada file materi
                        </div>
                        @endif
                    </div>

                    {{-- VIDEO --}}
                    @if($modul->video_url)
                    @php
                    $video = $modul->video_url;
                    if(str_contains($video, 'youtu.be')){
                    $video = str_replace('youtu.be/','www.youtube.com/embed/',explode('?',$video)[0]);
                    } else {
                    $video = str_replace('watch?v=','embed/',$video);
                    }
                    @endphp

                    <div x-data="{ showVideo:false }">
                        <button
                            @click="showVideo = !showVideo"
                            class="inline-flex items-center gap-2 px-5 py-3 bg-indigo-50 text-indigo-700 rounded-2xl hover:bg-indigo-100 transition font-medium">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4"
                                viewBox="0 0 24 24"
                                fill="currentColor">
                                <path d="M8 5v14l11-7z" />
                            </svg>

                            <span x-text="showVideo ? 'Sembunyikan Video Pembelajaran' : 'Tampilkan Video Pembelajaran'"></span>
                        </button>

                        <div x-show="showVideo"
                            x-transition
                            class="mt-4 aspect-video rounded-3xl overflow-hidden shadow-lg border">
                            <iframe class="w-full h-full"
                                src="{{ $video }}"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                    @endif

                </section>

                {{-- DISKUSI --}}
                <section class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 sm:p-8 space-y-6"
                    x-data="{ replyId:null }">

                    <h3 class="text-2xl font-black text-blue-900">
                        💬 Diskusi Materi
                    </h3>

                    {{-- FORM --}}
                    <form action="{{ route('komentar.store') }}" method="POST" class="space-y-3">
                        @csrf
                        <input type="hidden" name="modul_id" value="{{ $modul->id }}">

                        <textarea name="isi"
                            rows="3"
                            required
                            placeholder="Tulis komentar..."
                            class="w-full rounded-2xl border-slate-300 focus:ring-blue-500"></textarea>

                        <button type="submit"
                            class="px-5 py-2.5 bg-blue-700 text-white rounded-2xl hover:bg-blue-800 transition">
                            Kirim Komentar
                        </button>
                    </form>

                    {{-- LIST KOMEN --}}
                    <div class="space-y-5">

                        @forelse ($modul->comments->where('parent_id', null) as $komen)

                        <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200">

                            <div class="flex justify-between items-center">
                                <span class="font-bold text-slate-800">{{ $komen->user->name }}</span>

                                <span class="text-xs px-3 py-1 rounded-full
                                    {{ $komen->user->role == 'guru'
                                        ? 'bg-blue-100 text-blue-700'
                                        : 'bg-slate-200 text-slate-600' }}">
                                    {{ $komen->user->role }}
                                </span>
                            </div>

                            <p class="text-slate-700 mt-3">{{ $komen->isi }}</p>
                            <p class="text-xs text-slate-400 mt-1">{{ $komen->created_at->diffForHumans() }}</p>

                            <button
                                @click="replyId = {{ $komen->id }}"
                                class="text-sm text-blue-600 mt-3 font-medium">
                                Balas
                            </button>

                            {{-- FORM REPLY --}}
                            <div x-show="replyId === {{ $komen->id }}" class="mt-3">
                                <form action="{{ route('komentar.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="modul_id" value="{{ $modul->id }}">
                                    <input type="hidden" name="parent_id" value="{{ $komen->id }}">

                                    <textarea name="isi"
                                        rows="2"
                                        required
                                        placeholder="Tulis balasan..."
                                        class="w-full rounded-xl border-slate-300"></textarea>

                                    <button class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-xl text-sm">
                                        Kirim Balasan
                                    </button>
                                </form>
                            </div>

                            {{-- REPLIES --}}
                            <div class="ml-4 sm:ml-8 mt-4 space-y-3">
                                @foreach ($komen->replies as $reply)
                                <div class="bg-white rounded-2xl p-4 border border-slate-200">
                                    <div class="flex justify-between items-center">
                                        <span class="font-semibold text-sm">{{ $reply->user->name }}</span>
                                        <span class="text-xs {{ $reply->user->role == 'guru' ? 'text-blue-600' : 'text-slate-500' }}">
                                            {{ $reply->user->role }}
                                        </span>
                                    </div>

                                    <p class="text-sm text-slate-700 mt-2">{{ $reply->isi }}</p>
                                    <p class="text-xs text-slate-400 mt-1">{{ $reply->created_at->diffForHumans() }}</p>
                                </div>
                                @endforeach
                            </div>

                        </div>

                        @empty
                        <p class="text-slate-400">Belum ada komentar</p>
                        @endforelse

                    </div>
                </section>

                {{-- BUTTON --}}
                <div class="flex justify-end">
                    <a href="{{ route('guru.modul.index') }}"
                        class="inline-flex items-center gap-2 px-5 py-3 bg-white border border-slate-300 text-slate-600 rounded-full hover:bg-slate-50 transition shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="w-4 h-4">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 18l-6-6 6-6" />
                        </svg>
                        <span>Kembali</span>
                    </a>
                </div>

            </div>

        </main>
    </div>

</x-app-layout>