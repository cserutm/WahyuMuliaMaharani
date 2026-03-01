<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Materi Pembelajaran
        </h2>
    </x-slot>

    <div class="flex min-h-screen bg-gray-50">
        @include('layouts.sidebar')

        <main class="flex-1 p-10">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                {{-- Card Modul --}}
                <a href="{{ route('siswa.materi.modul') }}"
                   class="bg-gradient-to-br from-blue-100 to-pink-50 p-6 rounded-2xl shadow text-center block
              transform transition duration-300 hover:shadow-xl hover:-translate-y-1 active:scale-95">
        <h3 class="font-semibold text-gray-700">Materi file</h3>
                    <p class="text-sm text-gray-500 mt-2">
                        Lihat dan unduh materi pembelajaran
                    </p>
                </a>

                {{-- Card Video --}}
                <a href="{{ route('siswa.materi.video') }}"
                   class="bg-gradient-to-br from-purple-100 to-blue-50 p-6 rounded-2xl shadow text-center block
              transform transition duration-300 hover:shadow-xl hover:-translate-y-1 active:scale-95">
        <h3 class="font-semibold text-gray-700">Materi Video</h3>
                    <p class="text-sm text-gray-500 mt-2">
                        Tonton video pembelajaran
                    </p>
                </a>

            </div>

        </main>
    </div>
</x-app-layout>