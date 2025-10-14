<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">

       <!-- Global Bubble Loader -->
<div id="loader" class="fixed inset-0 bg-white bg-opacity-50 flex items-center justify-center z-50">
    <div class="flex items-end space-x-2">
        <div class="w-2 h-2 bg-blue-200 rounded-full animate-bounce" style="animation-delay: 0s;"></div>
        <div class="w-3 h-3 bg-blue-300 rounded-full animate-bounce" style="animation-delay: 0.1s;"></div>
        <div class="w-4 h-4 bg-blue-400 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
        <div class="w-3 h-3 bg-blue-300 rounded-full animate-bounce" style="animation-delay: 0.3s;"></div>
        <div class="w-2 h-2 bg-blue-200 rounded-full animate-bounce" style="animation-delay: 0.4s;"></div>
    </div>
</div>
        

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
 <script>
window.addEventListener('load', () => {
    const loader = document.getElementById('loader');
    
    // minimal tampil 1 detik
    setTimeout(() => {
        loader.style.display = 'none';
    }, 1000); // 1000ms = 1 detik
});
</script>


    </body>
</html>
