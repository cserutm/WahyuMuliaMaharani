<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AlPro</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900">

    @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Register</a>
                @endif
            @endauth
        </div>
    @endif

    {{-- Hero Section --}}
    <section class="bg-gray-50 py-20">
        <div class="container mx-auto flex flex-col-reverse md:flex-row items-center px-6 md:px-12">
            <div class="md:w-1/2 text-center md:text-left space-y-6">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 leading-tight">
                    Selamat Datang di <br>
                    <span class="text-indigo-600">Media Pembelajaran Algoritma dan Pemrograman</span>
                </h1>
                <p class="text-gray-600">
                    Platform interaktif untuk memahami konsep algoritma dan logika pemrograman dengan cara yang mudah dan menyenangkan.
                </p>
                <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-xl shadow hover:bg-indigo-700 transition">
                    Mulai Belajar
                </a>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <img src="{{ asset('images/hero.png') }}" alt="Belajar Pemrograman" class="w-80 md:w-96">
            </div>
        </div>
    </section>


    {{-- Video Section --}}
    <section class="py-20 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">
                Saksikan Penjelasan Materi dalam <br> Video untuk Mendukung Belajarmu
            </h2>
            <a href="#" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-xl shadow hover:bg-indigo-700 transition">
                Lihat Video
            </a>
            <div class="mt-10 flex justify-center">
                <img src="{{ asset('images/video-preview.png') }}" alt="Video Pembelajaran" class="rounded-2xl shadow-lg w-3/4 md:w-2/4">
            </div>
        </div>
    </section>

    {{-- Kuis Interaktif Section --}}
    <section class="bg-indigo-50 py-20">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">
                Kuis Interaktif Untuk Mengukur Kemampuanmu
            </h2>
            <p class="text-gray-600 mb-8">
                Tantang dirimu dengan kuis berbasis topik untuk memperdalam pemahaman materi.
            </p>
            <a href="#" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-xl shadow hover:bg-indigo-700 transition">
                Mulai Kuis
            </a>
            <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-6 justify-center">
                <img src="{{ asset('images/html.png') }}" alt="HTML" class="w-16 mx-auto">
                <img src="{{ asset('images/css.png') }}" alt="CSS" class="w-16 mx-auto">
                <img src="{{ asset('images/js.png') }}" alt="JavaScript" class="w-16 mx-auto">
                <img src="{{ asset('images/python.png') }}" alt="Python" class="w-16 mx-auto">
            </div>
        </div>
    </section>

    {{-- Panduan Section --}}
    <section class="py-20 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">
                Bingung Cara Menggunakan Media? Yuk Lihat Panduannya!
            </h2>
            <p class="text-gray-600 mb-8">
                Kami siapkan panduan langkah demi langkah agar kamu lebih mudah memahami cara menggunakan platform ini.
            </p>
            <a href="#" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-xl shadow hover:bg-indigo-700 transition">
                Lihat Panduan
            </a>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-100 py-6 text-center text-gray-600">
        <p>© {{ date('Y') }} AlPro | Media Pembelajaran Interaktif</p>
    </footer>


        </div>
    </body>
</html>
