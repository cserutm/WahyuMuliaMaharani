<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AlPro</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    @vite('resources/css/app.css')

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.80);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .blob {
            animation: blobMove 18s infinite alternate;
        }

        @keyframes blobMove {
            0% {
                transform: translate(0, 0) scale(1);
            }

            100% {
                transform: translate(60px, -40px) scale(1.2);
            }
        }

        .float-card {
            animation: floatCard 4s ease-in-out infinite;
        }

        @keyframes floatCard {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .reveal {
            opacity: 0;
            transform: translateY(60px);
            transition: all .9s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .mouse-glow {
            position: fixed;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle,
                    rgba(59, 130, 246, 0.10),
                    transparent 70%);
            pointer-events: none;
            z-index: 1;
            transform: translate(-50%, -50%);
        }

        @media(max-width:768px) {
            .mouse-glow {
                display: none;
            }

            html,
            body {
                overflow-x: hidden;
                max-width: 100%;
            }

            section {
                overflow: hidden;
            }
        }

        /* ================= HARDWARE ================= */

        .hardware-float {
            animation: hardwareFloat 5s ease-in-out infinite;
        }

        .hardware-float-delay {
            animation: hardwareFloat 6s ease-in-out infinite;
            animation-delay: 1s;
        }

        .hardware-rotate {
            animation: hardwareRotate 10s linear infinite;
        }

        @keyframes hardwareFloat {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        @keyframes hardwareRotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="antialiased text-slate-700 bg-slate-50 overflow-x-hidden">

    {{-- glow cursor --}}
    <div class="mouse-glow" id="mouseGlow"></div>

    {{-- ================= NAVBAR ================= --}}
    <nav x-data="{open:false}"
        class="fixed top-0 left-0 right-0 bg-white/90 backdrop-blur-xl border-b border-slate-100 z-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 h-20 flex items-center justify-between">

            <a href="{{ url('/') }}" class="flex items-center gap-3">

                <img src="{{ asset('images/LOGO-SMANSABAYA.png') }}"
                    class="w-10 h-10 sm:w-12 sm:h-12 object-contain">

                <div class="flex flex-col">
                    <span class="font-black text-blue-900 leading-none text-sm sm:text-lg">
                        ALPRO
                    </span>

                    <span
                        class="text-[9px] sm:text-[10px] text-blue-500 font-bold uppercase tracking-[2px]">
                        SMAN 1 Arosbaya
                    </span>
                </div>
            </a>

            {{-- desktop --}}
            <div class="hidden md:flex items-center gap-6 text-sm font-bold">

                <a href="#fitur" class="hover:text-blue-900 transition">
                    Fitur
                </a>

                <a href="{{ asset('panduan/PANDUAN_MEDIA.pdf') }}"
                    download="Panduan Media Pembelajaran.pdf"
                    class="px-5 py-2.5 bg-emerald-500 text-white rounded-full hover:bg-emerald-600 transition shadow-lg">

                    Download Panduan Penggunaan Website
                </a>

                @auth
                <a href="{{ url('/dashboard-siswa') }}"
                    class="px-5 py-2.5 bg-blue-900 text-white rounded-full">

                    Dashboard
                </a>
                @else
                <a href="{{ route('login') }}">
                    Masuk
                </a>

                <a href="{{ route('register') }}"
                    class="px-5 py-2.5 bg-blue-900 text-white rounded-full">

                    Daftar Akun
                </a>
                @endauth
            </div>

            {{-- mobile --}}
            <button @click="open=!open"
                class="md:hidden text-blue-900">


                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-7 h-7"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        {{-- mobile menu --}}
        <div x-show="open"
            x-transition
            class="md:hidden bg-white border-t px-4 pb-5 space-y-3">

            <a href="#fitur"
                class="block py-2 font-semibold text-blue-900">
                Fitur
            </a>

            <a href="{{ asset('panduan/panduan-media-pembelajaran.pdf') }}"
                download
                class="block py-2 font-semibold text-emerald-600">

                Download Panduan PDF
            </a>

            @auth
            <a href="{{ url('/dashboard-siswa') }}"
                class="block py-2 font-semibold text-blue-900">

                Dashboard
            </a>
            @else
            <a href="{{ route('login') }}"
                class="block py-2 font-semibold text-blue-900">

                Masuk
            </a>

            <a href="{{ route('register') }}"
                class="block py-2 font-semibold text-blue-900">

                Daftar Akun
            </a>
            @endauth
        </div>
    </nav>

    {{-- ================= HERO ================= --}}
    <section class="relative pt-36 sm:pt-44 pb-20 sm:pb-32 overflow-hidden">

        {{-- blob background --}}
        <div class="absolute inset-0 -z-10">

            <div
                class="absolute top-0 left-0 w-[300px] sm:w-[450px] h-[300px] sm:h-[450px] bg-blue-200 rounded-full blur-[120px] opacity-50 blob">
            </div>

            <div
                class="absolute bottom-0 right-0 w-[300px] sm:w-[450px] h-[300px] sm:h-[450px] bg-indigo-200 rounded-full blur-[120px] opacity-50 blob">
            </div>
        </div>

        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 grid lg:grid-cols-2 gap-12 items-center">

            {{-- left --}}
            <div
                class="space-y-6 sm:space-y-8 animate__animated animate__fadeInLeft relative z-10 text-center lg:text-left">

                <div
                    class="inline-flex items-center gap-2 px-4 py-1 rounded-full bg-blue-50 border border-blue-100">

                    <span
                        class="animate-ping inline-flex h-2 w-2 rounded-full bg-blue-500">
                    </span>

                    <span
                        class="text-[10px] sm:text-[11px] font-bold text-blue-900 uppercase">
                        Media Pembelajaran Interaktif
                    </span>
                </div>

                <h1
                    class="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 leading-tight">

                    Belajar Algoritma & <br>

                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-blue-900 to-blue-500">

                        Pemrograman Lebih Menarik
                    </span>
                </h1>

                <p
                    class="text-sm sm:text-lg text-slate-600 max-w-xl leading-relaxed mx-auto lg:mx-0">

                    Platform pembelajaran berbasis website yang membantu siswa memahami algoritma serta konsep dasar pemrograman melalui materi visual dan evaluasi interaktif.
                </p>

                <div
                    class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">

                    <a href="{{ route('register') }}"
                        class="px-8 py-4 bg-blue-900 text-white rounded-2xl font-bold shadow-xl">

                        Mulai Belajar
                    </a>

                    <a href="{{ route('login') }}"
                        class="px-8 py-4 bg-white border rounded-2xl font-bold">

                        Login Siswa
                    </a>
                </div>
            </div>

            {{-- right --}}
            <div class="relative animate__animated animate__fadeInRight mt-8 lg:mt-0">

                {{-- Laptop --}}
                <div class="absolute top-0 left-0 
hardware-float z-20 
scale-[0.45] sm:scale-75 lg:scale-100 
origin-top-left opacity-90">
                    <div
                        class="bg-white shadow-2xl rounded-3xl p-4 border border-slate-200 rotate-[-12deg]">

                        <div
                            class="w-44 h-28 bg-slate-900 rounded-2xl relative overflow-hidden">

                            <div
                                class="absolute inset-2 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl">
                            </div>

                            <div
                                class="absolute bottom-2 left-1/2 -translate-x-1/2 w-16 h-1.5 bg-slate-300 rounded-full">
                            </div>
                        </div>

                        <div class="w-52 h-3 bg-slate-300 rounded-b-2xl mx-auto"></div>
                    </div>
                </div>

                {{-- Handphone --}}
                <div class="absolute bottom-0 right-0 
hardware-float-delay z-20 
scale-[0.45] sm:scale-75 lg:scale-100 
origin-bottom-right opacity-90">

                    <div
                        class="bg-white shadow-2xl rounded-[2rem] p-2 border border-slate-200 rotate-[10deg]">

                        <div
                            class="w-28 h-52 rounded-[1.5rem] bg-slate-900 p-2 relative overflow-hidden">

                            <div
                                class="w-full h-full rounded-[1.2rem] bg-gradient-to-b from-blue-500 via-indigo-500 to-sky-400">
                            </div>

                            <div
                                class="absolute top-2 left-1/2 -translate-x-1/2 w-12 h-1.5 bg-slate-700 rounded-full">
                            </div>

                            <div
                                class="absolute bottom-3 left-1/2 -translate-x-1/2 w-10 h-10 rounded-full border-2 border-white/40">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Monitor --}}
                <div class="absolute top-8 right-[-70px] sm:right-[-40px] lg:right-[-80px]
hardware-float-delay z-10
scale-[0.4] sm:scale-75 lg:scale-100
origin-top-right opacity-70">

                    <div class="relative">

                        <div
                            class="bg-slate-900 rounded-[2rem] p-3 shadow-[0_25px_60px_rgba(0,0,0,0.35)] border-[6px] border-slate-800">

                            <div
                                class="w-[260px] h-[160px] rounded-[1.2rem] overflow-hidden relative bg-gradient-to-br from-blue-600 via-indigo-500 to-cyan-400">

                                <div class="absolute inset-0 bg-white/10"></div>

                                <div
                                    class="absolute top-4 left-4 right-4 h-5 rounded-full bg-white/20">
                                </div>

                                <div
                                    class="absolute top-14 left-5 w-24 h-3 rounded-full bg-white/40">
                                </div>

                                <div
                                    class="absolute top-24 left-5 w-40 h-3 rounded-full bg-white/30">
                                </div>

                                <div
                                    class="absolute top-34 left-5 w-32 h-3 rounded-full bg-white/20">
                                </div>

                                <div
                                    class="absolute bottom-5 right-5 w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md animate-pulse">
                                </div>
                            </div>
                        </div>

                        <div class="w-16 h-8 bg-slate-700 mx-auto rounded-b-xl"></div>
                        <div class="w-32 h-3 bg-slate-500 mx-auto rounded-full"></div>
                    </div>
                </div>

                {{-- rotating --}}
                <div class="absolute top-1/2 right-[-40px]
hardware-rotate opacity-40
scale-50 sm:scale-75 lg:scale-100">

                    <div
                        class="w-24 h-24 border-[10px] border-blue-200 border-t-blue-500 rounded-full">
                    </div>
                </div>




            </div>
        </div>
    </section>
    {{-- ================= FITUR ================= --}}
    <section id="fitur" class="relative py-20 sm:py-24 bg-blue-900 text-blue-50 overflow-hidden">

        {{-- HARDWARE BACKGROUND --}}
        <div class="absolute inset-0 overflow-hidden">

            {{-- MONITOR --}}
            <div class="absolute top-10 left-[-50px]
hardware-float opacity-10 sm:opacity-20
scale-50 sm:scale-75 lg:scale-100
origin-top-left">
                <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-3xl p-4 rotate-[-10deg]">
                    <div class="w-64 h-40 bg-slate-900 rounded-2xl overflow-hidden relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-indigo-600"></div>
                    </div>
                    <div class="w-12 h-6 bg-white/20 mx-auto"></div>
                    <div class="w-28 h-3 bg-white/20 rounded-full mx-auto"></div>
                </div>
            </div>

            {{-- KEYBOARD --}}
            <div class="absolute bottom-6 left-2 sm:left-16
hardware-float-delay opacity-10 sm:opacity-20
scale-50 sm:scale-75 lg:scale-100
origin-bottom-left">
                <div class="bg-white/10 border border-white/10 rounded-2xl p-3 rotate-[8deg] backdrop-blur-xl">
                    <div class="grid grid-cols-8 gap-1">
                        @for($i = 0; $i < 32; $i++)
                            <div class="w-4 h-4 rounded bg-white/20">
                    </div>
                    @endfor
                </div>
            </div>
        </div>

        {{-- TABLET --}}
        <div class="absolute top-16 right-0
hardware-float opacity-10 sm:opacity-20
scale-50 sm:scale-75 lg:scale-100
origin-top-right">
            <div class="bg-white/10 border border-white/10 rounded-[2rem] p-2 rotate-[12deg] backdrop-blur-xl">
                <div class="w-40 h-56 rounded-[1.5rem] bg-slate-900 p-3">
                    <div class="w-full h-full rounded-[1rem] bg-gradient-to-b from-blue-500 to-cyan-400"></div>
                </div>
            </div>
        </div>

        {{-- PHONE --}}
        <div class="absolute bottom-10 right-4 sm:right-24
hardware-float-delay opacity-10 sm:opacity-20
scale-50 sm:scale-75 lg:scale-100
origin-bottom-right">
            <div class="bg-white/10 border border-white/10 rounded-[2rem] p-2 rotate-[-10deg] backdrop-blur-xl">
                <div class="w-24 h-44 rounded-[1.5rem] bg-slate-900 p-2 relative">
                    <div class="w-full h-full rounded-[1rem] bg-gradient-to-b from-indigo-500 to-sky-400"></div>

                    <div class="absolute top-3 left-1/2 -translate-x-1/2 w-10 h-1 bg-slate-700 rounded-full"></div>
                </div>
            </div>
        </div>

        {{-- MOUSE --}}
        <div class="absolute bottom-24 right-2 sm:right-10
hardware-float opacity-10 sm:opacity-20
scale-50 sm:scale-75 lg:scale-100">
            <div class="w-16 h-24 rounded-full bg-white/10 border border-white/10 relative backdrop-blur-xl rotate-[15deg]">
                <div class="absolute top-3 left-1/2 -translate-x-1/2 w-1 h-6 bg-white/30 rounded-full"></div>
            </div>
        </div>

        {{-- ROTATING ELEMENT --}}
        <div class="absolute top-1/2 left-1/2
hardware-rotate opacity-5 sm:opacity-10
scale-50 sm:scale-75 lg:scale-100">
            <div class="w-80 h-80 border-[18px] border-white/10 border-t-white/40 rounded-full"></div>
        </div>

        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center mb-14 reveal relative z-10">
            <h2 class="text-3xl sm:text-4xl font-black mb-4">
                Fitur Utama Media Pembelajaran
            </h2>

            <p class="text-blue-200 text-sm sm:text-base">
                Disusun untuk memberikan pengalaman belajar yang aktif, visual, dan mudah dipahami.
            </p>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 grid md:grid-cols-3 gap-8 relative z-10">

            <div
                class="reveal p-8 rounded-3xl bg-white/5 border border-white/10 hover:bg-white/10 transition duration-300 backdrop-blur-xl">
                <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center mb-5 text-2xl">
                    📘
                </div>

                <h3 class="text-xl font-bold mb-3">Materi Terstruktur</h3>

                <p class="text-blue-100 text-sm">
                    Materi pembelajaran disusun secara sistematis sesuai capaian pembelajaran.
                </p>
            </div>

            <div
                class="reveal p-8 rounded-3xl bg-white/5 border border-white/10 hover:bg-white/10 transition duration-300 backdrop-blur-xl">
                <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center mb-5 text-2xl">
                    🧠
                </div>

                <h3 class="text-xl font-bold mb-3">Evaluasi Interaktif</h3>

                <p class="text-blue-100 text-sm">
                    Tersedia latihan pilihan ganda, drag and drop, serta evaluasi otomatis.
                </p>
            </div>

            <div
                class="reveal p-8 rounded-3xl bg-white/5 border border-white/10 hover:bg-white/10 transition duration-300 backdrop-blur-xl">
                <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center mb-5 text-2xl">
                    🏆
                </div>

                <h3 class="text-xl font-bold mb-3">Leaderboard</h3>

                <p class="text-blue-100 text-sm">
                    Sistem peringkat nilai memberikan motivasi kepada siswa untuk bersaing sehat.
                </p>
            </div>

        </div>
    </section>

    {{-- ================= CTA ================= --}}
    <section class="relative py-20 sm:py-24 bg-blue-900 overflow-hidden">

        {{-- HARDWARE ELEMENT --}}
        <div class="absolute inset-0 overflow-hidden">

            {{-- MONITOR --}}
            <div class="absolute left-[-40px] bottom-4
hardware-float opacity-10 sm:opacity-20
scale-50 sm:scale-75 lg:scale-100
origin-bottom-left">
                <div class="bg-white/10 rounded-3xl p-4 rotate-[-12deg] backdrop-blur-xl border border-white/10">
                    <div class="w-72 h-44 bg-slate-900 rounded-2xl overflow-hidden">
                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600"></div>
                    </div>

                    <div class="w-14 h-6 bg-white/20 mx-auto"></div>
                    <div class="w-32 h-3 bg-white/20 rounded-full mx-auto"></div>
                </div>
            </div>

            {{-- KEYBOARD --}}
            <div class="absolute left-4 sm:left-32 bottom-0
hardware-float-delay opacity-10 sm:opacity-20
scale-50 sm:scale-75 lg:scale-100">
                <div class="bg-white/10 border border-white/10 rounded-2xl p-3 rotate-[8deg] backdrop-blur-xl">
                    <div class="grid grid-cols-10 gap-1">
                        @for($i = 0; $i < 40; $i++)
                            <div class="w-3 h-3 rounded bg-white/20">
                    </div>
                    @endfor
                </div>
            </div>
        </div>

        {{-- TABLET --}}
        <div class="absolute top-10 right-10 hidden xl:block hardware-float opacity-20">
            <div class="bg-white/10 rounded-[2rem] p-2 rotate-[10deg] backdrop-blur-xl border border-white/10">
                <div class="w-44 h-60 rounded-[1.5rem] bg-slate-900 p-3">
                    <div class="w-full h-full rounded-[1rem] bg-gradient-to-b from-cyan-500 to-blue-500"></div>
                </div>
            </div>
        </div>

        {{-- PHONE --}}
        <div class="absolute bottom-6 right-2 sm:right-32
hardware-float-delay opacity-10 sm:opacity-20
scale-50 sm:scale-75 lg:scale-100">
            <div class="bg-white/10 rounded-[2rem] p-2 rotate-[-8deg] backdrop-blur-xl border border-white/10">
                <div class="w-24 h-48 rounded-[1.5rem] bg-slate-900 p-2 relative">
                    <div class="w-full h-full rounded-[1rem] bg-gradient-to-b from-blue-500 to-indigo-500"></div>
                </div>
            </div>
        </div>

        {{-- MOUSE --}}
        <div class="absolute bottom-16 right-0 sm:right-8
hardware-float opacity-10 sm:opacity-20
scale-50 sm:scale-75 lg:scale-100">
            <div class="w-16 h-24 rounded-full bg-white/10 border border-white/10 relative backdrop-blur-xl">
                <div class="absolute top-4 left-1/2 -translate-x-1/2 w-1 h-6 bg-white/30 rounded-full"></div>
            </div>
        </div>

        {{-- CIRCLE --}}
        <div class="absolute top-1/2 left-1/2
hardware-rotate opacity-5 sm:opacity-10
scale-50 sm:scale-75 lg:scale-100">
            <div class="w-96 h-96 border-[18px] border-white/10 border-t-white/40 rounded-full"></div>
        </div>

        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10">

            <div
                class="rounded-[2rem] sm:rounded-[3rem] bg-white/5 border border-white/10 backdrop-blur-xl p-8 sm:p-16 text-center text-white relative overflow-hidden">

                <div
                    class="absolute -top-20 left-1/2 -translate-x-1/2 w-96 h-96 bg-blue-400/20 rounded-full blur-[120px]">
                </div>

                <div class="relative z-10">

                    <div
                        class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white/10 border border-white/10 mb-6">
                        <span class="w-2 h-2 rounded-full bg-cyan-300 animate-ping"></span>

                        <span class="text-xs font-bold uppercase tracking-[2px]">
                            Media Pembelajaran
                        </span>
                    </div>

                    <h2 class="text-3xl sm:text-5xl font-black mb-6 leading-tight">
                        Mulai Pembelajaran <br>

                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-200 to-blue-400">
                            Sekarang Juga
                        </span>
                    </h2>

                    <p class="text-blue-100 max-w-2xl mx-auto mb-8 text-sm sm:text-base leading-relaxed">
                        Gunakan media pembelajaran ini untuk mempelajari algoritma dan pemrograman
                        dengan pengalaman belajar modern, interaktif, dan lebih menyenangkan.
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center gap-4">

                        <a href="{{ route('register') }}"
                            class="px-10 py-4 bg-white text-blue-900 rounded-2xl font-black shadow-2xl hover:scale-105 transition">
                            Daftar Akun
                        </a>

                        <a href="{{ route('login') }}"
                            class="px-10 py-4 border border-white/30 rounded-2xl font-bold hover:bg-white/10 transition">
                            Login
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="//unpkg.com/alpinejs" defer></script>

    <script>
        const reveals = document.querySelectorAll('.reveal');

        window.addEventListener('scroll', () => {
            reveals.forEach(r => {
                let top = r.getBoundingClientRect().top;

                if (top < window.innerHeight - 80) {
                    r.classList.add('active');
                }
            });
        });

        const glow = document.getElementById('mouseGlow');

        document.addEventListener('mousemove', e => {
            if (glow) {
                glow.style.left = e.clientX + 'px';
                glow.style.top = e.clientY + 'px';
            }
        });
    </script>

</body>

</html>