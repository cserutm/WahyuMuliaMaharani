<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<nav x-data="{ open: false }"
    class="bg-white/95 backdrop-blur-sm border-b border-gray-100 fixed top-0 left-0 right-0 z-50 h-16 shadow-sm">

    <div class="w-full h-16 px-4 sm:px-6 lg:px-8 flex justify-between items-center">

        {{-- KIRI --}}
        <div class="flex items-center gap-3">

            {{-- HAMBURGER HP --}}
            <button @click="open = !open"
                class="lg:hidden p-2 rounded-md text-gray-500 hover:bg-gray-100 transition">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <x-application-logo class="w-8" />

            <div class="h-8 w-px bg-gray-200"></div>

            <div class="leading-tight max-w-[170px] sm:max-w-none">
                <p class="text-[10px] sm:text-xs uppercase tracking-widest text-blue-600 font-semibold">
                    Media Pembelajaran
                </p>
                <h1 class="text-[11px] sm:text-base font-bold text-gray-800 leading-tight">
                    Materi Algoritma dan Pemrograman
                </h1>
            </div>
        </div>

        {{-- PROFILE DESKTOP --}}
        <div class="hidden lg:flex items-center">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 rounded-md bg-white hover:text-gray-700 transition">
                        <div class="flex items-center gap-3">
                            <img
                                src="{{ Auth::user()->foto 
                                    ? asset('storage/' . Auth::user()->foto) 
                                    : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                class="w-9 h-9 rounded-full object-cover border border-gray-200 shadow-sm">

                            <div class="text-sm font-medium text-gray-700">
                                {{ Auth::user()->name }}
                            </div>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();this.closest('form').submit();">
                            Log Out
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>

    {{-- MENU MOBILE --}}
    <div x-show="open"
        x-cloak
        @click.away="open = false"
        class="lg:hidden fixed top-16 left-0 w-full h-[calc(100vh-4rem)] bg-white z-[9999] overflow-y-auto shadow-xl border-t">

        <div class="px-4 py-4 border-b bg-gray-50">
            <div class="font-semibold text-gray-800">{{ Auth::user()->name }}</div>
            <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
        </div>

        <div class="py-2">
            <a href="{{ route('guru.dashboard') }}" class="block px-4 py-3 border-b">Dashboard</a>
            <a href="{{ route('guru.semester.index') }}" class="block px-4 py-3 border-b">Kelola Semester</a>
            <a href="{{ route('guru.classes.index') }}" class="block px-4 py-3 border-b">Kelola Kelas</a>
            <a href="{{ route('guru.modul.index') }}" class="block px-4 py-3 border-b">Kelola Materi</a>
            <a href="{{ route('guru.kuis.index') }}" class="block px-4 py-3 border-b">Kelola Evaluasi</a>
            <a href="{{ route('guru.nilai') }}" class="block px-4 py-3 border-b">Lihat Nilai</a>
            <a href="{{ route('guru.leaderboard') }}" class="block px-4 py-3 border-b">Leaderboard Siswa</a>
            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 border-b">Profile</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();this.closest('form').submit();"
                    class="block px-4 py-3 text-red-500">
                    Log Out
                </a>
            </form>
        </div>
    </div>
</nav>