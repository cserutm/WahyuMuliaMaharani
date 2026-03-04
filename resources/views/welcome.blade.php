<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Media Pembelajaran | Algoritma & Pemrograman</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body class="antialiased text-gray-700 bg-gray-50">

{{-- ================= NAVBAR ================= --}}
@if (Route::has('login'))
<div class="fixed top-0 left-0 right-0 bg-white/80 backdrop-blur-md border-b border-gray-100 z-50">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">

         {{-- LOGO --}}
        <a href="{{ url('/') }}" class="flex items-center">
            <x-application-logo class="w-8 h-8 text-blue-600" />
        </a>

        <div class="space-x-6 text-sm">
            @auth
                <a href="{{ url('/dashboard-siswa') }}"
                   class="text-gray-600 hover:text-blue-600 transition">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="text-gray-600 hover:text-blue-600 transition">
                    Login
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition shadow-sm">
                        Daftar
                    </a>
                @endif
            @endauth
        </div>

    </div>
</div>
@endif


{{-- ================= HERO ================= --}}
<section class="pt-32 pb-24 bg-gradient-to-br from-blue-50 via-indigo-50 to-blue-100">
    <div class="max-w-4xl mx-auto text-center px-6 space-y-8">

        <p class="text-xs uppercase tracking-widest text-blue-600 font-semibold">
            SMAN 1 AROSBAYA
        </p>

        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight">
            Media Pembelajaran <br>
            Algoritma dan Pemrograman
        </h1>

        <p class="text-gray-600 text-lg leading-relaxed max-w-2xl mx-auto">
            Platform pembelajaran modern untuk memahami konsep algoritma,
            logika pemrograman, serta implementasi dasar secara terstruktur,
            interaktif, dan mudah dipahami.
        </p>

        <div class="flex justify-center gap-4 pt-6">
            <a href="{{ route('login') }}"
               class="px-8 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition shadow-md">
                Mulai Belajar
            </a>

            <a href="#fitur"
               class="px-8 py-3 bg-white text-gray-700 rounded-xl border border-gray-200 hover:border-blue-400 hover:text-blue-600 transition shadow-sm">
                Lihat Fitur
            </a>
        </div>

        <p class="text-gray-400 text-sm pt-4">
            Digunakan oleh Guru dan Siswa dalam proses pembelajaran.
        </p>

    </div>
</section>


{{-- ================= FITUR ================= --}}
<section id="fitur" class="py-24 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <h2 class="text-3xl font-bold text-gray-800 mb-4">
            Fitur Unggulan
        </h2>

        <p class="text-gray-500 mb-16">
            Mendukung pembelajaran yang efektif dan terarah.
        </p>

        <div class="grid md:grid-cols-3 gap-10">

            {{-- Materi --}}
            <div class="p-8 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition">
                <div class="w-14 h-14 bg-blue-100 text-blue-600 flex items-center justify-center rounded-xl mb-6 mx-auto">
                    <!-- Book Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="font-semibold text-lg text-gray-800 mb-3">
                    Materi Terstruktur
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Penyampaian materi sistematis dari konsep dasar
                    hingga implementasi pemrograman.
                </p>
            </div>

            {{-- Video --}}
            <div class="p-8 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition">
                <div class="w-14 h-14 bg-indigo-100 text-indigo-600 flex items-center justify-center rounded-xl mb-6 mx-auto">
                    <!-- Video Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14m-6 4h6a2 2 0 002-2V8a2 2 0 00-2-2H9a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-lg text-gray-800 mb-3">
                    Video Pembelajaran
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Penjelasan visual untuk memperjelas alur logika
                    dan proses pemrograman.
                </p>
            </div>

            {{-- Kuis --}}
            <div class="p-8 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition">
                <div class="w-14 h-14 bg-purple-100 text-purple-600 flex items-center justify-center rounded-xl mb-6 mx-auto">
                    <!-- Quiz Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M8 10h.01M12 14h.01M16 10h.01M9 16h6m-9 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-lg text-gray-800 mb-3">
                    Kuis Interaktif
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Evaluasi berbasis topik untuk mengukur pemahaman
                    dan perkembangan belajar.
                </p>
            </div>

        </div>
    </div>
</section>


{{-- ================= CTA ================= --}}
<section class="py-24 bg-blue-600 text-white">
    <div class="max-w-3xl mx-auto text-center px-6 space-y-6">

        <h2 class="text-3xl font-bold">
            Tingkatkan Pemahamanmu Sekarang
        </h2>

        <p class="text-blue-100">
            Masuk ke sistem dan mulai proses pembelajaran secara terarah.
        </p>

        <a href="{{ route('login') }}"
           class="inline-block px-8 py-3 bg-white text-blue-600 rounded-xl hover:bg-gray-100 transition shadow-md">
            Akses Platform
        </a>

    </div>
</section>


{{-- ================= FOOTER ================= --}}
<footer class="bg-gray-300 text-gray-900 py-10 text-center text-sm">
    © {{ date('Y') }} Media Pembelajaran Algoritma dan Pemrograman
</footer>

</body>
</html>