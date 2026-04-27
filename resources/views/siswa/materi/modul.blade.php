<x-app-layout>

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Konten Utama --}}
    <main class="ml-64 pt-16 px-10 pb-16 min-h-screen bg-gray-100">
        {{-- ================= NOTIF ================= --}}
        <div class="flex justify-end -mt-6 mb-2"
            x-data="{ openNotif:false }">

            <div class="relative">

                {{-- ICON --}}
                <button @click="openNotif = !openNotif"
                    class="relative p-2 rounded-full
                       bg-white border border-gray-200
                       text-gray-600
                       hover:bg-blue-50 hover:text-blue-600
                       transition shadow-sm">

                    {{-- SVG BELL --}}
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 17h5l-1.405-1.405
                         A2.032 2.032 0 0118 14.158V11
                         a6.002 6.002 0 00-4-5.659V5
                         a2 2 0 10-4 0v.341
                         C7.67 6.165 6 8.388 6 11v3.159
                         c0 .538-.214 1.055-.595 1.436L4 17h5
                         m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>

                    @php
                    $unread = auth()->user()->notifications->where('is_read', false)->count();
                    @endphp

                    {{-- BADGE --}}
                    @if($unread > 0)
                    <span class="absolute -top-1 -right-1
                             bg-red-500 text-white text-[10px]
                             px-1.5 py-0.5 rounded-full
                             font-semibold shadow">
                        {{ $unread }}
                    </span>
                    @endif

                </button>

                {{-- DROPDOWN --}}
                <div x-show="openNotif"
                    @click.away="openNotif=false"
                    x-transition
                    class="absolute right-0 mt-3 w-80
                    bg-white shadow-xl rounded-2xl p-4 z-50
                    border border-gray-100">

                    <h4 class="text-sm font-semibold text-gray-700 mb-3">
                        Notifikasi
                    </h4>

                    @forelse(auth()->user()->notifications->take(5) as $notif)

                    <div class="p-3 rounded-lg hover:bg-gray-50 transition border-b">

                        <div class="flex items-start gap-2">

                            {{-- ICON MINI --}}
                            <div class="mt-1 text-blue-500">
                                🔔
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-800">
                                    {{ $notif->judul }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    {{ $notif->pesan }}
                                </p>

                                <p class="text-[10px] text-gray-400 mt-1">
                                    {{ $notif->created_at->diffForHumans() }}
                                </p>
                            </div>

                        </div>

                    </div>

                    @empty
                    <p class="text-sm text-gray-400 text-center py-4">
                        Tidak ada notifikasi
                    </p>
                    @endforelse

                </div>

            </div>

        </div>

        <div class="max-w-6xl mx-auto">

            <div class="grid gap-8 [grid-template-columns:repeat(auto-fit,minmax(280px,1fr))]">

                @forelse($moduls as $modul)

                <div class="bg-white border border-gray-200 
            rounded-2xl p-6 shadow-sm
            hover:shadow-lg hover:border-blue-200
            transition-all duration-300 group">

                    {{-- HEADER --}}
                    <div class="flex items-start gap-4">

                        {{-- ICON --}}
                        <div class="bg-blue-50 text-blue-600 p-3 rounded-xl group-hover:scale-105 transition">
                            {{-- BOOK ICON --}}
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.253v13M12 6.253C10.832 5.477 9.246 5 7.5 5
                       5.754 5 4.168 5.477 3 6.253v13
                       C4.168 18.477 5.754 18 7.5 18
                       c1.746 0 3.332.477 4.5 1.253m0-13
                       C13.168 5.477 14.754 5 16.5 5
                       c1.746 0 3.332.477 4.5 1.253v13
                       C19.832 18.477 18.246 18 16.5 18
                       c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>

                        {{-- TITLE --}}
                        <div class="flex-1">
                            <h3 class="text-sm font-semibold text-gray-400">
                                Materi {{ $loop->iteration }}
                            </h3>

                            <p class="text-base font-semibold text-gray-800 leading-snug">
                                {{ $modul->judul }}
                            </p>
                        </div>
                    </div>

                    {{-- TUJUAN --}}
                    @if($modul->tujuan_pembelajaran)
                    <div class="mt-4 p-3 bg-blue-50 border border-blue-100 rounded-xl">
                        <p class="text-[11px] font-semibold text-blue-700 uppercase tracking-wide mb-1">
                            Tujuan Pembelajaran
                        </p>
                        <p class="text-xs text-blue-600 leading-relaxed">
                            {{ $modul->tujuan_pembelajaran }}
                        </p>
                    </div>
                    @endif

                    {{-- DESKRIPSI --}}
                    @if($modul->deskripsi)
                    <p class="mt-3 text-xs text-gray-500 leading-relaxed">
                        {{ $modul->deskripsi }}
                    </p>
                    @endif

                    {{-- ACTION BUTTON --}}
                    <div class="flex flex-wrap gap-3 mt-5">

                        @if($modul->file_materi)

                        {{-- LIHAT --}}
                        <a href="{{ asset('storage/' . $modul->file_materi) }}"
                            target="_blank"
                            class="inline-flex items-center gap-2
                   px-4 py-2 text-xs font-medium
                   bg-gray-100 text-gray-600
                   rounded-full
                   hover:bg-gray-200 transition">

                            {{-- EYE ICON --}}
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5
                       c4.477 0 8.268 2.943 9.542 7
                       -1.274 4.057-5.065 7-9.542 7
                       -4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                            Lihat
                        </a>

                        {{-- DOWNLOAD --}}
                        <a href="{{ route('siswa.modul.download', $modul->id) }}"
                            class="inline-flex items-center gap-2
                   px-4 py-2 text-xs font-medium
                   bg-blue-600 text-white
                   rounded-full
                   shadow-sm
                   hover:bg-blue-700 transition">

                            {{-- DOWNLOAD ICON --}}
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 4v10m0 0l-3-3m3 3l3-3" />
                            </svg>

                            Download
                        </a>

                        @endif

                    </div>

                    {{-- VIDEO --}}
                    @if($modul->video_url)

                    @php
                    $video = $modul->video_url;

                    if(str_contains($video,'youtu.be')){
                    $video = str_replace('youtu.be/','www.youtube.com/embed/',explode('?',$video)[0]);
                    } else {
                    $video = str_replace('watch?v=','embed/',$video);
                    }
                    @endphp

                    <div x-data="{ showVideo: false }" class="mt-5">

                        {{-- BUTTON --}}
                        <button
                            @click="showVideo = !showVideo"
                            class="inline-flex items-center gap-2
               text-xs font-medium text-blue-600
               hover:text-blue-700 transition">

                            {{-- PLAY ICON (lebih clean) --}}
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4"
                                viewBox="0 0 24 24"
                                fill="currentColor">
                                <path d="M8 5v14l11-7z" />
                            </svg>

                            <span x-text="showVideo ? 'Sembunyikan Video' : 'Preview Video'"></span>
                        </button>

                        {{-- VIDEO FRAME --}}
                        <div x-show="showVideo"
                            x-transition
                            class="mt-3 w-full aspect-video rounded-xl overflow-hidden border">

                            <iframe class="w-full h-full"
                                src="{{ $video }}"
                                allowfullscreen>
                            </iframe>

                        </div>

                    </div>

                    @endif

                </div>

                @empty
                {{-- Empty State --}}
                <div class="col-span-full bg-white border border-gray-200
                                rounded-2xl p-12 text-center shadow-sm">

                    <div class="mx-auto w-16 h-16 bg-blue-50 text-blue-600
                                    rounded-2xl flex items-center justify-center mb-5">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24"
                            stroke-width="1.8" stroke="currentColor"
                            class="w-8 h-8">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800">
                        Belum Ada Materi
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Materi akan muncul setelah guru mengunggahnya.
                    </p>
                </div>
                @endforelse

                {{-- ================= KOMENTAR ================= --}}
                <div class="mt-6 border-t pt-4" x-data="{ replyId: null }">

                    <h4 class="text-sm font-semibold text-gray-700 mb-2">
                        Diskusi
                    </h4>

                    {{-- FORM KOMENTAR --}}
                    <form action="{{ route('komentar.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="modul_id" value="{{ $modul->id }}">

                        <textarea name="isi"
                            rows="2"
                            required
                            placeholder="Tulis komentar..."
                            class="w-full border rounded p-2 text-sm"></textarea>

                        <button class="mt-1 text-xs bg-blue-600 text-white px-3 py-1 rounded">
                            Kirim
                        </button>
                    </form>

                    {{-- LIST KOMENTAR --}}
                    <div class="mt-3 space-y-2 max-h-60 overflow-y-auto">

                        @forelse ($modul->comments->where('parent_id', null) as $komen)

                        <div class="bg-gray-100 p-2 rounded">

                            <div class="flex justify-between">
                                <span class="text-xs font-semibold">
                                    {{ $komen->user->name }}
                                </span>

                                <span class="text-[10px]
                    {{ $komen->user->role == 'guru'
                        ? 'text-blue-500'
                        : 'text-gray-500' }}">
                                    {{ $komen->user->role }}
                                </span>
                            </div>

                            <p class="text-xs mt-1">{{ $komen->isi }}</p>

                            {{-- BUTTON REPLY --}}
                            <button @click="replyId = {{ $komen->id }}"
                                class="text-[10px] text-blue-500 mt-1">
                                Balas
                            </button>

                            {{-- FORM REPLY --}}
                            <div x-show="replyId === {{ $komen->id }}" class="mt-1">
                                <form action="{{ route('komentar.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="modul_id" value="{{ $modul->id }}">
                                    <input type="hidden" name="parent_id" value="{{ $komen->id }}">

                                    <textarea name="isi"
                                        class="w-full border rounded p-1 text-xs"></textarea>

                                    <button class="text-[10px] bg-blue-500 text-white px-2 py-1 mt-1 rounded">
                                        Kirim
                                    </button>
                                </form>
                            </div>

                            {{-- REPLIES --}}
                            <div class="ml-3 mt-1 space-y-1">
                                @foreach ($komen->replies as $reply)
                                <div class="bg-white p-1 rounded text-xs">
                                    <b>{{ $reply->user->name }}</b>:
                                    {{ $reply->isi }}
                                </div>
                                @endforeach
                            </div>

                        </div>

                        @empty
                        <p class="text-xs text-gray-400">
                            Belum ada komentar
                        </p>
                        @endforelse

                    </div>

                </div>

            </div>

            {{-- Button Kembali --}}
            <div class="mt-10 flex justify-end">
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center gap-2
                          px-5 py-2.5 text-sm
                          bg-white border border-gray-300
                          text-gray-600
                          rounded-full
                          hover:bg-gray-50 hover:border-gray-400
                          transition">
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

</x-app-layout>