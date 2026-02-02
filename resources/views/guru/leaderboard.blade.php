<x-app-layout>
    {{-- Header slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leaderboard') }}
        </h2>
    </x-slot>

    {{-- Layout --}}
    <div class="flex min-h-screen bg-gray-50 text-gray-800">

        {{-- Sidebar --}}
       
            @include('guru.sidebar')
      

        {{-- Konten --}}
        <main class="flex-1 p-10 overflow-y-auto">

            <div class="bg-white rounded-3xl shadow-xl p-8 w-full max-w-3xl mx-auto">

                <h3 class="text-xl font-bold mb-6 text-center">
                    🏆 Peringkat Siswa
                </h3>

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b text-gray-600">
                            <th class="py-3 text-left">Rank</th>
                            <th class="py-3 text-left">Nama</th>
                            <th class="py-3 text-center">Total Kuis</th>
                            <th class="py-3 text-right">Total Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leaderboard as $index => $row)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 font-semibold">
                                @if($index === 0) 🥇
                                @elseif($index === 1) 🥈
                                @elseif($index === 2) 🥉
                                @else {{ $index + 1 }}
                                @endif
                            </td>

                            <td class="py-3">
                                {{ $row->user->name }}
                            </td>

                            <td class="py-3 text-center">
                                {{ $row->total_quiz }}
                            </td>

                            <td class="py-3 text-right font-bold text-blue-600">
                                {{ $row->total_score }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </main>
    </div>
</x-app-layout>
