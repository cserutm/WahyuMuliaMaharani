<x-app-layout>

    <div class="flex">

        {{-- Sidebar --}}
        @include('guru.sidebar')

        {{-- Konten --}}
        <main class="flex-1 ml-64 p-10 space-y-10">
            


            <div class="max-w-4xl mx-auto space-y-8">

                {{-- Header Card --}}
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 
                            rounded-2xl p-6 shadow-sm">

                    <h1 class="text-2xl font-bold text-gray-800">
                        {{ $modul->judul }}
                    </h1>

                    <p class="text-sm text-gray-500 mt-2">
                        Dibuat: {{ $modul->created_at->format('d M Y H:i') }}
                    </p>
                </div>

                {{-- Detail Card --}}
                <div class="bg-white rounded-2xl shadow-lg p-8 space-y-8">

                    {{-- Tujuan --}}
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">
                            Tujuan Pembelajaran
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $modul->tujuan_pembelajaran }}
                        </p>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">
                            Deskripsi
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $modul->deskripsi }}
                        </p>
                    </div>

                    {{-- File --}}
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-4">
                            File Materi
                        </h3>

                        @if($modul->file_materi)
                        <div class="flex flex-wrap gap-3 mt-3">

                            <a href="{{ asset('storage/' . $modul->file_materi) }}"
                                target="_blank"
                                class="inline-flex items-center gap-2
          px-4 py-2 text-sm
          bg-gray-100 text-gray-600
          rounded-full
          hover:bg-gray-200 transition">

                                {{-- ICON EYE CLEAN --}}
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

                                Lihat
                            </a>

                            <a href="{{ route('guru.modul.download', $modul->id) }}"
                                class="inline-flex items-center gap-2
          px-4 py-2 text-sm
          bg-blue-600 text-white
          rounded-full
          hover:bg-blue-700 transition">

                                {{-- ICON DOWNLOAD CLEAN --}}
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

                                Download
                            </a>
                        </div>
                        @else
                        <div class="bg-gray-50 rounded-xl p-4 text-gray-500">
                            Tidak ada file materi
                        </div>
                        @endif
                    </div>

                    {{-- Preview Video --}}
                    @if($modul->video_url)
                    @php
                    $video = $modul->video_url;
                    if(str_contains($video, 'youtu.be')){
                    $video = str_replace('youtu.be/','www.youtube.com/embed/',explode('?',$video)[0]);
                    } else {
                    $video = str_replace('watch?v=','embed/',$video);
                    }
                    @endphp

                    <div x-data="{ showVideo: false }" class="mt-6">
                        <button
                            @click="showVideo = !showVideo"
                            class="inline-flex items-center gap-2
           px-4 py-2
           text-sm font-medium
           text-blue-600
           hover:text-blue-700
           transition">

                            {{-- ICON PLAY CLEAN --}}
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4"
                                viewBox="0 0 24 24"
                                fill="currentColor">
                                <path d="M8 5v14l11-7z" />
                            </svg>

                            <span x-text="showVideo ? 'Sembunyikan Video' : 'Preview Video'"></span>
                        </button>

                        <div x-show="showVideo"
                            x-transition
                            class="mt-3 w-full aspect-video rounded-2xl overflow-hidden border shadow-sm">
                            <iframe class="w-full h-full"
                                src="{{ $video }}"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                    @endif

                </div>

                {{-- ================= KOMENTAR ================= --}}
                <div class="bg-white rounded-2xl shadow-lg p-6 space-y-6"
                    x-data="{ replyId: null }">

                    <h3 class="text-lg font-semibold text-gray-800">
                        Diskusi Materi
                    </h3>

                    {{-- FORM KOMENTAR UTAMA --}}
                    <form action="{{ route('komentar.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="modul_id" value="{{ $modul->id }}">

                        <textarea name="isi"
                            rows="3"
                            required
                            placeholder="Tulis komentar..."
                            class="w-full border rounded-lg p-3 text-sm"></textarea>

                        <button type="submit"
                            class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm">
                            Kirim Komentar
                        </button>
                    </form>

                    {{-- LIST KOMENTAR --}}
                    <div class="space-y-4">

                        @forelse ($modul->comments->where('parent_id', null) as $komen)

                        <div class="p-4 bg-gray-100 rounded-xl">

                            {{-- HEADER --}}
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-sm">
                                    {{ $komen->user->name }}
                                </span>

                                {{-- ROLE --}}
                                <span class="text-xs px-2 py-1 rounded-full
                    {{ $komen->user->role == 'guru'
                        ? 'bg-blue-100 text-blue-600'
                        : 'bg-gray-200 text-gray-600' }}">
                                    {{ $komen->user->role }}
                                </span>
                            </div>

                            {{-- ISI --}}
                            <p class="text-sm text-gray-700 mt-2">
                                {{ $komen->isi }}
                            </p>

                            {{-- WAKTU --}}
                            <p class="text-xs text-gray-400 mt-1">
                                {{ $komen->created_at->diffForHumans() }}
                            </p>

                            {{-- BUTTON REPLY --}}
                            <button
                                @click="replyId = {{ $komen->id }}"
                                class="text-xs text-blue-500 mt-2">
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
                                        class="w-full border rounded-lg p-2 text-sm"></textarea>

                                    <button class="mt-1 px-3 py-1 bg-blue-500 text-white rounded text-xs">
                                        Kirim Balasan
                                    </button>
                                </form>

                            </div>

                            {{-- REPLIES --}}
                            <div class="ml-6 mt-4 space-y-2">

                                @foreach ($komen->replies as $reply)

                                <div class="p-3 bg-white rounded-lg shadow-sm">

                                    <div class="flex justify-between">
                                        <span class="text-sm font-semibold">
                                            {{ $reply->user->name }}
                                        </span>

                                        <span class="text-xs
                            {{ $reply->user->role == 'guru'
                                ? 'text-blue-500'
                                : 'text-gray-500' }}">
                                            {{ $reply->user->role }}
                                        </span>
                                    </div>

                                    <p class="text-sm text-gray-700 mt-1">
                                        {{ $reply->isi }}
                                    </p>

                                    <p class="text-xs text-gray-400">
                                        {{ $reply->created_at->diffForHumans() }}
                                    </p>

                                </div>

                                @endforeach

                            </div>

                        </div>

                        @empty
                        <p class="text-sm text-gray-400">
                            Belum ada komentar
                        </p>
                        @endforelse

                    </div>

                </div>

                {{-- Button Kembali --}}
                <div class="mt-10 flex justify-end">
                    <a href="{{ route('guru.modul.index') }}"
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
    </div>

</x-app-layout>