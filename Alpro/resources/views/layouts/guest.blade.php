<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Alpro') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        .blob {
            animation: blobMove 18s infinite alternate;
        }

        @keyframes blobMove {
            0% {
                transform: translate(0, 0) scale(1);
            }

            100% {
                transform: translate(50px, -40px) scale(1.2);
            }
        }

        .glass-auth {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .float-logo {
            animation: floatLogo 4s ease-in-out infinite;
        }

        @keyframes floatLogo {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .mouse-glow {
            position: fixed;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.12), transparent 70%);
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

<body class="font-sans text-gray-900 antialiased overflow-x-hidden relative bg-slate-50">

    {{-- mouse glow --}}
    <div class="mouse-glow" id="mouseGlow"></div>

    {{-- animated background --}}
    <div class="absolute inset-0 -z-10 overflow-hidden">
        <div class="absolute top-0 left-0 w-[320px] sm:w-[450px] h-[320px] sm:h-[450px] bg-blue-200 rounded-full blur-[120px] opacity-50 blob"></div>
        <div class="absolute bottom-0 right-0 w-[320px] sm:w-[450px] h-[320px] sm:h-[450px] bg-indigo-200 rounded-full blur-[120px] opacity-50 blob"></div>
    </div>

    <!-- Global Bubble Loader -->
    <div id="loader" class="fixed inset-0 bg-white/70 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="flex items-end space-x-2">
            <div class="w-2 h-2 bg-blue-200 rounded-full animate-bounce" style="animation-delay:0s;"></div>
            <div class="w-3 h-3 bg-blue-300 rounded-full animate-bounce" style="animation-delay:0.1s;"></div>
            <div class="w-4 h-4 bg-blue-400 rounded-full animate-bounce" style="animation-delay:0.2s;"></div>
            <div class="w-3 h-3 bg-blue-300 rounded-full animate-bounce" style="animation-delay:0.3s;"></div>
            <div class="w-2 h-2 bg-blue-200 rounded-full animate-bounce" style="animation-delay:0.4s;"></div>
        </div>
    </div>

    <div class="min-h-screen flex flex-col justify-center items-center px-4 py-8 sm:px-6">

        {{-- logo --}}
        <div class="mb-6 sm:mb-8 relative z-10 float-logo">
            <a href="/" class="text-center block">
                <img src="{{ asset('images/LOGO-SMANSABAYA.png') }}" class="w-14 h-14 sm:w-16 sm:h-16 mx-auto object-contain mb-2">

                <p class="text-[10px] sm:text-xs tracking-[3px] uppercase text-blue-500 font-bold">SMAN 1 Arosbaya</p>
            </a>
        </div>

        {{-- auth card --}}
        <div class="w-full sm:max-w-md md:max-w-lg px-5 sm:px-8 py-6 sm:py-8 glass-auth shadow-2xl rounded-[2rem] relative z-10">
            {{ $slot }}
        </div>

        {{-- footer text --}}
        <p class="mt-6 text-[11px] sm:text-xs text-blue-400 font-medium text-center relative z-10 px-4">
            Media Pembelajaran Algoritma & Pemrograman © {{ date('Y') }}
        </p>
    </div>

    <script>
        window.addEventListener('load', () => {
            const loader = document.getElementById('loader');
            setTimeout(() => {
                loader.style.opacity = '0';
                loader.style.transition = '0.5s';
                setTimeout(() => loader.style.display = 'none', 500);
            }, 900);
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