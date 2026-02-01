<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Materi Teks
        </h2>
    </x-slot>

    {{-- Layout --}}
    <div class="flex min-h-screen bg-gray-50 text-gray-800">
        {{-- sidebar --}}
      @include('layouts.sidebar')

    <main id="materiContent"
          class="flex-1 p-10 overflow-y-auto h-screen">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-md p-8">

            <h1 class="text-2xl font-bold mb-4">
                <h1>{{ $materi?->judul ?? 'Algoritma dan Pemrograman' }}</h1>

            </h1>

            {{-- Gambar Materi --}}
            @if($materi && $materi->gambar)
                <img src="{{ asset('storage/'.$materi->gambar) }}" 
                     class="w-full rounded-xl mb-6">
            @endif

            {{-- Konten Materi --}}
            <p class="text-gray-700 leading-relaxed text-justify">
                {{ $materi->konten ?? 'Isi materi algoritma dan pemrograman...' }}
            </p>

        </div>

    </main>
</div>
   <script>
document.addEventListener('DOMContentLoaded', function () {

    window.addEventListener('scroll', function () {
        const scrollTop = window.scrollY;
        const documentHeight = document.documentElement.scrollHeight;
        const windowHeight = window.innerHeight;

        const scrollable = documentHeight - windowHeight;
        if (scrollable <= 0) return;

        const progress = Math.round((scrollTop / scrollable) * 100);

        localStorage.setItem('materi_progress', progress);
    });

});
</script>


</x-app-layout>
