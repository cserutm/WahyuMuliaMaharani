<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AlPro</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

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
            background: radial-gradient(circle, rgba(59, 130, 246, 0.10), transparent 70%);
            pointer-events: none;
            z-index: 1;
            transform: translate(-50%, -50%);
        }

        @media(max-width:768px) {
            .mouse-glow {
                display: none;
            }
        }
    </style>
</head>

<body class="antialiased text-slate-700 bg-slate-50 overflow-x-hidden">

    <div class="mouse-glow" id="mouseGlow"></div>

    {{-- ================= NAVBAR ================= --}}
    <nav x-data="{open:false}" class="fixed top-0 left-0 right-0 bg-white/90 backdrop-blur-xl border-b border-slate-100 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 h-20 flex items-center justify-between">

            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/LOGO-SMANSABAYA.png') }}" class="w-10 h-10 sm:w-12 sm:h-12 object-contain">
                <div class="flex flex-col">
                    <span class="font-black text-blue-900 leading-none text-sm sm:text-lg">ALPRO</span>
                    <span class="text-[9px] sm:text-[10px] text-blue-500 font-bold uppercase tracking-[2px]">SMAN 1 Arosbaya</span>
                </div>
            </a>

            {{-- desktop --}}
            <div class="hidden md:flex items-center gap-6 text-sm font-bold">
                <a href="#fitur" class="hover:text-blue-900 transition">Fitur</a>

                <a href="{{ asset('panduan/panduan-media-pembelajaran.pdf') }}" download="Panduan Media Pembelajaran.pdf"
                    class="px-5 py-2.5 bg-emerald-500 text-white rounded-full hover:bg-emerald-600 transition shadow-lg">
                    Download Panduan PDF
                </a>

                @auth
                <a href="{{ url('/dashboard-siswa') }}" class="px-5 py-2.5 bg-blue-900 text-white rounded-full">Dashboard</a>
                @else
                <a href="{{ route('login') }}">Masuk</a>
                <a href="{{ route('register') }}" class="px-5 py-2.5 bg-blue-900 text-white rounded-full">Daftar Akun</a>
                @endauth
            </div>

            {{-- mobile button --}}
            <button @click="open=!open" class="md:hidden text-blue-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        {{-- mobile menu --}}
        <div x-show="open" x-transition class="md:hidden bg-white border-t px-4 pb-5 space-y-3">
            <a href="#fitur" class="block py-2 font-semibold text-blue-900">Fitur</a>
            <a href="{{ asset('panduan/panduan-media-pembelajaran.pdf') }}" download class="block py-2 font-semibold text-emerald-600">Download Panduan PDF</a>

            @auth
            <a href="{{ url('/dashboard-siswa') }}" class="block py-2 font-semibold text-blue-900">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="block py-2 font-semibold text-blue-900">Masuk</a>
            <a href="{{ route('register') }}" class="block py-2 font-semibold text-blue-900">Daftar Akun</a>
            @endauth
        </div>
    </nav>

    {{-- ================= HERO ================= --}}
    <section class="relative pt-36 sm:pt-44 pb-20 sm:pb-32 overflow-hidden">
        <div class="absolute inset-0 -z-10">
            <div class="absolute top-0 left-0 w-[300px] sm:w-[450px] h-[300px] sm:h-[450px] bg-blue-200 rounded-full blur-[120px] opacity-50 blob"></div>
            <div class="absolute bottom-0 right-0 w-[300px] sm:w-[450px] h-[300px] sm:h-[450px] bg-indigo-200 rounded-full blur-[120px] opacity-50 blob"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 grid lg:grid-cols-2 gap-12 items-center">

            <div class="space-y-6 sm:space-y-8 animate__animated animate__fadeInLeft relative z-10 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-4 py-1 rounded-full bg-blue-50 border border-blue-100">
                    <span class="animate-ping inline-flex h-2 w-2 rounded-full bg-blue-500"></span>
                    <span class="text-[10px] sm:text-[11px] font-bold text-blue-900 uppercase">Media Pembelajaran Interaktif</span>
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 leading-tight">
                    Belajar Algoritma & <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-900 to-blue-500">Pemrograman Lebih Menarik</span>
                </h1>

                <p class="text-sm sm:text-lg text-slate-600 max-w-xl leading-relaxed mx-auto lg:mx-0">
                    Platform pembelajaran berbasis website yang membantu siswa memahami algoritma serta konsep dasar pemrograman melalui materi visual dan evaluasi interaktif.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-blue-900 text-white rounded-2xl font-bold shadow-xl">
                        Mulai Belajar
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-4 bg-white border rounded-2xl font-bold">
                        Login Siswa
                    </a>
                </div>
            </div>

            <div class="relative animate__animated animate__fadeInRight mt-8 lg:mt-0">
                <div class="glass-card rounded-[2rem] p-3 sm:p-5 shadow-2xl">
                    <img src="{{ asset('images/dashboard-preview.png') }}" class="rounded-[1.5rem] shadow-xl w-full" alt="">
                </div>

                <div class="absolute -bottom-4 left-2 sm:-left-6 bg-blue-900 text-white p-3 sm:p-4 rounded-2xl shadow-xl float-card text-xs sm:text-base">
                    <p class="text-blue-200 font-bold uppercase text-[10px]">Evaluasi Interaktif</p>
                    <p class="font-black">Quiz & Drag Drop</p>
                </div>

                <div class="absolute -top-4 right-2 sm:-right-6 bg-blue-900 text-white p-3 sm:p-4 rounded-2xl shadow-xl float-card text-xs sm:text-base">
                    <p class="text-blue-200 font-bold uppercase text-[10px]">Fitur Kompetitif</p>
                    <p class="font-black">Leaderboard</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= FITUR ================= --}}
    <section id="fitur" class="py-20 sm:py-24 bg-blue-900 text-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center mb-14 reveal">
            <h2 class="text-3xl sm:text-4xl font-black mb-4">Fitur Utama Media Pembelajaran</h2>
            <p class="text-blue-200 text-sm sm:text-base">Disusun untuk memberikan pengalaman belajar yang aktif, visual, dan mudah dipahami.</p>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 grid md:grid-cols-3 gap-8">
            <div class="reveal p-8 rounded-3xl bg-white/5 border border-white/10 hover:bg-white/10">
                <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center mb-5 text-2xl">📘</div>
                <h3 class="text-xl font-bold mb-3">Materi Terstruktur</h3>
                <p class="text-blue-100 text-sm">Materi pembelajaran disusun secara sistematis sesuai capaian pembelajaran.</p>
            </div>

            <div class="reveal p-8 rounded-3xl bg-white/5 border border-white/10 hover:bg-white/10">
                <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center mb-5 text-2xl">🧠</div>
                <h3 class="text-xl font-bold mb-3">Evaluasi Interaktif</h3>
                <p class="text-blue-100 text-sm">Tersedia latihan pilihan ganda, drag and drop, serta evaluasi otomatis.</p>
            </div>

            <div class="reveal p-8 rounded-3xl bg-white/5 border border-white/10 hover:bg-white/10">
                <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center mb-5 text-2xl">🏆</div>
                <h3 class="text-xl font-bold mb-3">Leaderboard</h3>
                <p class="text-blue-100 text-sm">Sistem peringkat nilai memberikan motivasi kepada siswa untuk bersaing sehat.</p>
            </div>
        </div>
    </section>

    {{-- ================= EFEKTIF ================= --}}
    <section class="py-20 sm:py-24 bg-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-14 reveal">
                <h2 class="text-3xl sm:text-4xl font-black text-blue-900 mb-4">Mengapa Media Ini Efektif?</h2>
                <p class="text-blue-700 max-w-2xl mx-auto text-sm sm:text-base">
                    Media pembelajaran dikembangkan untuk mendukung proses belajar yang lebih terarah,
                    interaktif, dan meningkatkan pemahaman siswa.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="reveal bg-white rounded-3xl p-8 border border-blue-100 hover:shadow-xl">
                    <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center mb-5 text-2xl">🎯</div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">Pembelajaran Terarah</h3>
                    <p class="text-sm text-blue-700">Materi disusun berdasarkan capaian pembelajaran secara sistematis.</p>
                </div>

                <div class="reveal bg-white rounded-3xl p-8 border border-blue-100 hover:shadow-xl">
                    <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center mb-5 text-2xl">💡</div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">Interaktif dan Menarik</h3>
                    <p class="text-sm text-blue-700">Video, gambar, dan evaluasi interaktif membuat siswa aktif belajar.</p>
                </div>

                <div class="reveal bg-white rounded-3xl p-8 border border-blue-100 hover:shadow-xl">
                    <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center mb-5 text-2xl">📈</div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">Meningkatkan Pemahaman</h3>
                    <p class="text-sm text-blue-700">Siswa dapat mengetahui hasil evaluasi secara langsung.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= CTA ================= --}}
    <section class="py-20 sm:py-24 bg-blue-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="rounded-[2rem] sm:rounded-[3rem] bg-white/5 border border-white/10 p-8 sm:p-16 text-center text-white">
                <h2 class="text-3xl sm:text-5xl font-black mb-6">Mulai Pembelajaran Sekarang</h2>
                <p class="text-blue-100 max-w-2xl mx-auto mb-8 text-sm sm:text-base">
                    Gunakan media pembelajaran ini untuk mempelajari algoritma dan pemrograman dengan lebih mudah dan menyenangkan.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('register') }}" class="px-10 py-4 bg-white text-blue-900 rounded-2xl font-black">Daftar Akun</a>
                    <a href="{{ route('login') }}" class="px-10 py-4 border border-white/30 rounded-2xl font-bold">Login</a>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-blue-950 py-8 text-center text-sm text-blue-200">
        © {{ date('Y') }} SMAN 1 Arosbaya — Media Pembelajaran Algoritma & Pemrograman
    </footer>

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