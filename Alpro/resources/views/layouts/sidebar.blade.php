{{-- Sidebar --}}
<aside class="hidden lg:block fixed top-16 left-0 w-64 h-[calc(100vh-4rem)]
             bg-blue-900 text-blue-50 px-6 py-6 overflow-y-auto">

    {{-- Logo / Section Title --}}
    <div class="mb-8">
        <h2 class="text-xs uppercase tracking-widest text-blue-300 font-semibold">
            Menu Utama Siswa
        </h2>
    </div>

    <nav class="space-y-2">

        <!-- Dashboard -->
        <a href="{{ route('dashboard-siswa') }}"
            class="group flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200
           {{ request()->routeIs('dashboard-siswa') 
                ? 'bg-white/10 text-white font-semibold'
                : 'text-blue-100 hover:bg-white/5 hover:text-white' }}">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 opacity-80 group-hover:opacity-100"
                fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h5m4 0h5a1 1 0 001-1V10" />
            </svg>

            <span>Dashboard</span>
        </a>

        <!-- Materi -->
        <a href="{{ route('siswa.materi.modul') }}"
            class="group flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200
           {{ request()->routeIs('siswa.materi.*') 
                ? 'bg-white/10 text-white font-semibold'
                : 'text-blue-100 hover:bg-white/5 hover:text-white' }}">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 opacity-80 group-hover:opacity-100"
                fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M7 8h10M7 12h6m2 8H7a2 2 0 01-2-2V6a2 2 0 012-2h7l4 4v12a2 2 0 01-2 2z" />
            </svg>

            <span>Materi</span>
        </a>

        <!-- Evaluasi -->
        <a href="{{ route('siswa.evaluasi.index') }}"
            class="group flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200
           {{ request()->routeIs('siswa.evaluasi.*') 
                ? 'bg-white/10 text-white font-semibold'
                : 'text-blue-100 hover:bg-white/5 hover:text-white' }}">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 opacity-80 group-hover:opacity-100"
                fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>

            <span>Evaluasi</span>
        </a>

        <!-- Leaderboard -->
        <a href="{{ route('siswa.leaderboard') }}"
            class="group flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200
           {{ request()->routeIs('siswa.leaderboard') 
                ? 'bg-white/10 text-white font-semibold'
                : 'text-blue-100 hover:bg-white/5 hover:text-white' }}">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 opacity-80 group-hover:opacity-100"
                fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 21h8m-4-4v4m5-10a5 5 0 01-10 0V4h10v7z" />
            </svg>

            <span>Progress Belajar</span>
        </a>

    </nav>

</aside>