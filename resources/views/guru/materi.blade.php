<x-app-layout>

    <div class="flex">

        {{-- Sidebar --}}
        @include('guru.sidebar')

        {{-- Konten --}}
        <main class="flex-1 ml-64 p-10 space-y-10">
            {{-- ================= NOTIF ================= --}}
            <div class="flex justify-end -mt-6 mb-2" x-data="{ openNotif:false }">

                @php
                $notifications = auth()->user()->notifications()->latest()->take(5)->get();
                $unread = auth()->user()->notifications()->where('is_read', false)->count();
                @endphp

                <div class="relative">

                    {{-- ICON BELL --}}
                    <button
                        @click="openNotif = !openNotif"
                        class="relative p-2 rounded-full bg-white border border-gray-200
                   text-gray-600 hover:bg-blue-50 hover:text-blue-600
                   transition shadow-sm">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11
                    a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341
                    C7.67 6.165 6 8.388 6 11v3.159
                    c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>

                        {{-- BADGE --}}
                        @if($unread > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px]
                             px-1.5 py-0.5 rounded-full font-semibold shadow">
                            {{ $unread }}
                        </span>
                        @endif

                    </button>

                    {{-- DROPDOWN --}}
                    <div
                        x-show="openNotif"
                        @click.away="openNotif=false"
                        x-transition
                        class="absolute right-0 mt-3 w-80 bg-white shadow-xl rounded-2xl
                   border border-gray-100 z-50 overflow-hidden">

                        {{-- HEADER --}}
                        <div class="flex justify-between items-center px-4 py-3 border-b">
                            <h4 class="text-sm font-semibold text-gray-700">Notifikasi</h4>

                            <a href="{{ route('notif.readAll') }}"
                                class="text-xs text-blue-500 hover:underline">
                                Tandai semua dibaca
                            </a>
                        </div>

                        {{-- LIST --}}
                        <div class="max-h-80 overflow-y-auto">

                            @forelse($notifications as $notif)

                            <a href="{{ route('notif.read', $notif->id) }}"
                                class="flex gap-3 px-4 py-3 hover:bg-gray-50 transition border-b">

                                {{-- ICON --}}
                                <div class="mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4
                                 {{ $notif->is_read ? 'text-gray-400' : 'text-blue-500' }}"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11
                                         a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341" />
                                    </svg>
                                </div>

                                {{-- CONTENT --}}
                                <div class="flex-1">

                                    <p class="text-sm font-medium
                                {{ $notif->is_read ? 'text-gray-500' : 'text-gray-800' }}">
                                        {{ $notif->judul }}
                                    </p>
                                    <h3 class="text-sm text-gray-500">
                                        Materi {{ $loop->iteration }}
                                    </h3>

                                    <p class="text-xs text-gray-500">
                                        {{ $notif->pesan }}
                                    </p>

                                    <p class="text-[10px] text-gray-400 mt-1">
                                        {{ $notif->created_at->diffForHumans() }}
                                    </p>

                                </div>

                                {{-- UNREAD DOT --}}
                                @if(!$notif->is_read)
                                <span class="w-2 h-2 bg-blue-500 rounded-full mt-2"></span>
                                @endif

                            </a>

                            @empty

                            <div class="p-4 text-center text-sm text-gray-400">
                                Tidak ada notifikasi
                            </div>

                            @endforelse

                        </div>

                    </div>

                </div>

            </div>

            {{-- Judul Halaman --}}
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">
                    Kelola Materi
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Daftar materi pembelajaran yang tersedia.
                </p>
            </div>


            {{-- LIST CARD MATERI --}}
            <div class="space-y-6">

                @forelse ($modul as $item)

                <a href="{{ route('guru.modul.index',$item->id) }}"
                    class="block group bg-white border border-gray-200 
                      rounded-2xl p-8 shadow-sm
                      hover:shadow-md hover:border-blue-200
                      transition-all duration-300">

                    <div class="flex items-start justify-between">

                        <div>

                            <h3 class="text-lg font-semibold text-gray-800">
                                Materi {{ $loop->iteration }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $item->judul }}
                            </p>


                            {{-- FILE + VIDEO --}}
                            <div class="flex items-center gap-6 mt-4">

                                {{-- FILE PDF --}}
                                @if($item->file_materi)
                                <span class="flex items-center gap-2 text-gray-500 text-sm">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.8"
                                        stroke="currentColor"
                                        class="w-5 h-5">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M7 7h10M7 11h6m-9 9h12a2 2 0 002-2V8l-4-4H5a2 2 0 00-2 2v12a2 2 0 002 2z" />

                                    </svg>

                                    File Materi
                                </span>
                                @endif


                                {{-- VIDEO --}}
                                @if($item->video_url)
                                <span class="flex items-center gap-2 text-gray-500 text-sm">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.8"
                                        stroke="currentColor"
                                        class="w-5 h-5">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14m-6 4h6a2 2 0 002-2V8a2 2 0 00-2-2H9a2 2 0 00-2 2v8a2 2 0 002 2z" />

                                    </svg>

                                    Video Pembelajaran
                                </span>
                                @endif

                            </div>

                        </div>


                        {{-- ICON CARD --}}
                        <div class="bg-blue-50 text-blue-600 p-4 rounded-xl">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.8"
                                stroke="currentColor"
                                class="w-6 h-6">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M7 8h10M7 12h6m2 8H7a2 2 0 01-2-2V6a2 2 0 012-2h7l4 4v12a2 2 0 01-2 2z" />

                            </svg>

                        </div>

                    </div>

                </a>

                @empty

                <div class="text-center text-gray-400 py-20">
                    Belum ada materi tersedia
                </div>

                @endforelse

            </div>

        </main>

    </div>

</x-app-layout>