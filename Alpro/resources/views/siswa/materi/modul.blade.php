<x-app-layout>
    <div class="flex">

        @include('layouts.sidebar')

        <main class="flex-1 ml-0 lg:ml-64 p-4 sm:p-6 bg-slate-50">

            <div class="max-w-7xl mx-auto space-y-6">

                {{-- ================= NOTIFIKASI (1 KALI SAJA) ================= --}}
                <div class="flex justify-end"
                    x-data="{ openNotif:false }">

                    @php
                    $unread = auth()->user()->notifications
                    ->where('is_read', false)
                    ->count();
                    @endphp

                    <button
                        @click="openNotif=!openNotif"
                        class="relative bg-white p-3 rounded-2xl shadow border hover:bg-slate-50 transition">

                        🔔

                        @if($unread)

                        <span
                            class="absolute -top-1 -right-1
                    bg-red-500 text-white
                    text-[10px]
                    px-1.5 py-0.5
                    rounded-full">

                            {{ $unread }}

                        </span>

                        @endif

                    </button>

                    <div
                        x-show="openNotif"
                        x-transition
                        @click.away="openNotif=false"

                        class="absolute right-6 mt-16
                w-80 bg-white rounded-3xl
                shadow-xl border p-4 z-50">

                        <h4 class="font-bold mb-3">

                            Notifikasi

                        </h4>

                        @forelse(auth()->user()->notifications->take(5) as $notif)

                        <div class="border-b py-3">

                            <p class="font-semibold">

                                {{ $notif->judul }}

                            </p>

                            <p class="text-sm text-slate-500">

                                {{ $notif->pesan }}

                            </p>

                        </div>

                        @empty

                        <p>Tidak ada notifikasi</p>

                        @endforelse

                    </div>

                </div>


                {{-- ================= PERULANGAN MATERI ================= --}}

                @forelse($moduls as $modul)

                {{-- ================= HEADER ================= --}}

                <div class="bg-white border rounded-3xl p-8">

                    <div class="flex flex-col lg:flex-row justify-between gap-6">

                        <div class="flex gap-5">

                            <div class="w-24 h-24 rounded-3xl bg-blue-100 flex items-center justify-center text-5xl">

                                📖

                            </div>

                            <div>

                                <span class="bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-sm font-semibold">

                                    Materi {{ $loop->iteration }}

                                </span>

                                <h1 class="text-4xl font-bold mt-3">

                                    {{ $modul->judul }}

                                </h1>

                                <p class="text-slate-500 mt-2 whitespace-pre-line">

                                    {{ $modul->deskripsi }}

                                </p>

                            </div>

                        </div>

                        <div class="flex flex-wrap gap-3">

                            @if($modul->file_materi)

                            <a
                                href="{{ route('siswa.modul.download',$modul->id) }}"

                                class="px-6 py-4 border rounded-2xl font-semibold hover:bg-slate-50">

                                ⬇ Download Materi

                            </a>

                            <a
                                href="#materi{{ $modul->id }}"

                                class="px-6 py-4 bg-blue-600 text-white rounded-2xl font-semibold hover:bg-blue-700">

                                📖 Buka Materi

                            </a>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- ================= RINGKASAN ================= --}}

                @if($modul->ringkasan)

                <div class="bg-purple-100 border rounded-3xl p-6 
            transition transform hover:-translate-y-1 hover:shadow-xl duration-300">

                    <h3 class="font-bold text-blue-700 mb-4">

                        📘 Ringkasan Materi

                    </h3>

                    <p class="text-slate-700 leading-relaxed whitespace-pre-line
          hover:text-slate-900 transition">

                        {{ $modul->ringkasan }}

                    </p>

                </div>

                @endif


                {{-- ================= POIN PENTING + TAHUKAH KAMU ================= --}}

                <div class="grid lg:grid-cols-2 gap-6">

                    {{-- POIN PENTING --}}
                    @if($modul->poin_penting)

                    <div class="bg-yellow-50 border border-yellow-200 rounded-3xl p-6 self-start
            transition transform hover:-translate-y-1 hover:shadow-xl duration-300">

                        <h3 class="font-bold text-yellow-700 mb-4">

                            ⭐ Poin Penting

                        </h3>

                        <div class="space-y-3">

                            @foreach(explode("\n",$modul->poin_penting) as $point)

                            @if(trim($point))

                            <div class="flex gap-3">

                                <span>✔</span>

                                <span>{{ $point }}</span>

                            </div>

                            @endif

                            @endforeach

                        </div>

                    </div>

                    @endif


                    {{-- TAHUKAH KAMU --}}
                    @if($modul->fakta_menarik)

                    <div class="bg-blue-100 border border-purple-200 rounded-3xl p-6 self-start
            transition transform hover:-translate-y-1 hover:shadow-xl duration-300">

                        <div class="flex justify-between items-center gap-5">

                            <div class="flex-1">

                                <h3 class="font-bold text-blue-700 mb-4">

                                    💡 Tahukah Kamu?

                                </h3>

                                <p class="text-slate-700 whitespace-pre-line">

                                    {{ $modul->fakta_menarik }}

                                </p>

                            </div>

                            <div class="hidden md:block">

                                <img

                                    src="{{ asset('images/FaktaMenarik.png') }}"

                                    class="w-32 h-auto"

                                    alt="Tahukah Kamu">

                            </div>

                        </div>

                    </div>

                    @endif

                </div>


                {{-- ================= ILUSTRASI + PDF ================= --}}

                <div class="grid lg:grid-cols-2 gap-6">

                    {{-- ILUSTRASI --}}
                    @if($modul->gambar_materi)

                    <div class="bg-green-50 border border-green-200 rounded-3xl p-6">

                        <h3 class="font-bold text-green-700 mb-4">

                            🖼️ Ilustrasi Materi

                        </h3>

                        <img

                            src="{{ asset('storage/'.$modul->gambar_materi) }}"

                            class="w-full rounded-2xl">

                    </div>

                    @endif


                    {{-- PDF --}}
                    @if($modul->file_materi)

                    <div

                        id="materi{{ $modul->id }}"

                        class="bg-white border rounded-3xl p-6">

                        <h3 class="font-bold text-blue-700">

                            📄 Materi Lengkap (PDF)

                        </h3>

                        <p class="text-sm text-slate-500 mb-4">

                            Baca materi lengkap dalam format PDF

                        </p>

                        <iframe

                            src="{{ asset('storage/'.$modul->file_materi) }}"

                            class="w-full rounded-2xl"

                            style="height:500px">

                        </iframe>

                    </div>

                    @endif

                </div>


                {{-- ================= VIDEO ================= --}}

                @if($modul->video_url)

                @php

                $video = $modul->video_url;

                if(str_contains($video,'youtu.be')){

                $video = str_replace('youtu.be/','www.youtube.com/embed/',explode('?',$video)[0]);

                }else{

                $video = str_replace('watch?v=','embed/',$video);

                }

                @endphp

                <div class="bg-white border rounded-3xl p-6">

                    <h3 class="font-bold mb-4">

                        🎥 Video Pembelajaran

                    </h3>

                    <div class="aspect-video rounded-2xl overflow-hidden">

                        <iframe

                            src="{{ $video }}"

                            class="w-full h-full"

                            allowfullscreen>

                        </iframe>

                    </div>

                </div>

                @endif


                {{-- ================= DISKUSI ================= --}}

                <div class="bg-white border rounded-3xl p-6">

                    {{-- TEMPELKAN KODE DISKUSI YANG LAMA DI SINI --}}

                </div>

                @empty

                <div class="bg-white rounded-3xl p-12 text-center">

                    Belum ada materi.

                </div>

                @endforelse


                {{-- TOMBOL KEMBALI --}}

                <div class="flex justify-end">

                    <a

                        href="{{ url()->previous() }}"

                        class="px-5 py-2 rounded-full border bg-white">

                        Kembali

                    </a>

                </div>

            </div>

        </main>
        <style>
            .flip-page {
                animation: flipPage .5s ease;
            }

            @keyframes flipPage {
                from {
                    transform: rotateY(-90deg);
                    opacity: 0;
                }

                to {
                    transform: rotateY(0deg);
                    opacity: 1;
                }
            }
        </style>
</x-app-layout>