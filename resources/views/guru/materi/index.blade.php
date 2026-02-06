<x-app-layout>
  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola quiz') }}
        </h2>
    </x-slot>

    {{-- Layout --}}
    <div class="flex min-h-screen bg-gray-50 text-gray-800">
        {{-- sidebar --}}
      @include('guru.sidebar')


        {{-- Konten Utama --}}
        <main class="flex-1 p-10 overflow-y-auto">
</main>
</div>
</x-app-layout>
