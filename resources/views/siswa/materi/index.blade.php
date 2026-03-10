<x-app-layout>

{{-- Sidebar --}}
@include('layouts.sidebar')

{{-- Konten Utama --}}
<main class="ml-64 pt-16 px-10 pb-16 min-h-screen bg-gray-100">

<div class="max-w-7xl mx-auto">

<div class="grid grid-cols-1 gap-6">

{{-- Card Modul --}}
<a href="{{ route('siswa.materi.modul') }}"
class="group bg-white border border-gray-200
rounded-2xl p-8 shadow-sm
hover:shadow-md hover:border-blue-200
transition-all duration-300">

<div class="flex items-center justify-between">

<div class="flex items-center gap-5">

{{-- Icon --}}
<div class="bg-blue-50 text-blue-600 p-4 rounded-xl">
<svg xmlns="http://www.w3.org/2000/svg"
fill="none" viewBox="0 0 24 24"
stroke-width="1.8" stroke="currentColor"
class="w-7 h-7">
<path stroke-linecap="round"
stroke-linejoin="round"
d="M12 6v12m6-6H6"/>
</svg>
</div>

<div>
<h3 class="text-lg font-semibold text-gray-800">
Materi file dan video
</h3>
<p class="text-sm text-gray-500 mt-1">
Akses file pembelajaran dan materi tertulis.
</p>
</div>

</div>

{{-- Arrow icon --}}
<div class="text-gray-400 group-hover:text-blue-500">

<svg xmlns="http://www.w3.org/2000/svg"
fill="none"
viewBox="0 0 24 24"
stroke-width="1.8"
stroke="currentColor"
class="w-6 h-6">

<path stroke-linecap="round"
stroke-linejoin="round"
d="M9 5l7 7-7 7"/>

</svg>

</div>

</div>

</a>

</div>

</div>

</main>

</x-app-layout>