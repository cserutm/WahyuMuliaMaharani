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


    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kelola Kuis</h1>

        {{-- Tombol Tambah --}}
        <a href="{{ route('guru.quiz.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600  text-white rounded-lg ">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4v16m8-8H4" />
            </svg>
            Tambah Kuis
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                 <tr class="border-b text-gray-600">
                    <th class="px-6 py-3 text-left">No</th>
                    <th class="px-6 py-3 text-left">Judul</th>
                    <th class="px-6 py-3 text-left">Kelas</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse ($quizzes as $index => $quiz)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3">{{ $quiz->id }}</td>
                        <td class="px-6 py-3 font-medium">{{ $quiz->judul }}</td>
                        <td class="px-6 py-3 text-gray-600">{{ $quiz->kelas}}</td>
                        <td class="px-6 py-3 text-gray-600">{{ $quiz->status}}</td>

                        {{-- Aksi --}}
                            <td class="px-4 py-3">
    <div class="flex justify-center items-center gap-3
                sm:gap-4
                text-sm">

        {{-- Edit --}}
        <a href="{{ route('guru.quiz.edit', $quiz->id) }}"
           class="flex items-center gap-1 text-blue-600 hover:text-blue-800 transition"
           title="Edit Kuis">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-4 h-4 sm:w-5 sm:h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11
                         a2 2 0 002 2h11a2 2 0 002-2v-5
                         m-1.414-9.414
                         a2 2 0 112.828 2.828L11.828 15
                         H9v-2.828l8.586-8.586z" />
            </svg>

      
            <span class="hidden sm:inline">Edit</span>
        </a>

        {{-- Hapus --}}
        <form action="{{ route('guru.quiz.destroy', $quiz->id) }}"
              method="POST"
              onsubmit="return confirm('Yakin hapus kuis ini?')">
            @csrf
            @method('DELETE')

            <button type="submit"
                class="flex items-center gap-1 text-red-600 hover:text-red-800 transition"
                title="Hapus Kuis">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-4 h-4 sm:w-5 sm:h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                             a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7
                             h6m2 0H7m2-3h6a1 1 0 011 1v1H8V5
                             a1 1 0 011-1z" />
                </svg>

                <span class="hidden sm:inline">Hapus</span>
            </button>
        </form>

    </div>
</td>


                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            Belum ada kuis
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>
</div>
</x-app-layout>
