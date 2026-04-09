<x-app-layout>

    <div class="flex">
 
    {{-- Sidebar --}}
    @include('guru.sidebar')

    {{-- Konten Utama --}}
   <main class="flex-1 ml-64 p-10">

            <div class="bg-white p-8 rounded-2xl shadow-sm">

    <h3 class="text-xl font-semibold text-blue-900 mb-6">
        Peringkat Siswa
    </h3>

    <div class="overflow-x-auto">
        <form method="GET" class="mb-6">
    <select name="class_id" onchange="this.form.submit()"
        class="border rounded-lg px-4 py-2 text-sm">

        <option value="">Semua Kelas</option>

        @foreach($classes as $class)
            <option value="{{ $class->id }}"
                {{ $classId == $class->id ? 'selected' : '' }}>
                {{ $class->nama_kelas }}
            </option>
        @endforeach

    </select>
</form>
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-100 text-blue-900 uppercase tracking-wider text-xs">
                <tr>
                    <th class="px-6 py-3">Rank</th>
                    <th class="px-6 py-3">Nama</th>
                     <th class="px-6 py-3">Kelas</th>
                    <th class="px-6 py-3 text-center">Total Kuis</th>
                    <th class="px-6 py-3 text-right">Total Nilai</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach($leaderboard as $index => $row)
                <tr class="hover:bg-gray-50 transition">

                    {{-- Rank --}}
                    <td class="px-6 py-4 font-semibold">
                        @if($index === 0)
                            <span class="px-3 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded-full">
                                #1
                            </span>
                        @elseif($index === 1)
                            <span class="px-3 py-1 text-xs font-semibold bg-gray-200 text-gray-700 rounded-full">
                                #2
                            </span>
                        @elseif($index === 2)
                            <span class="px-3 py-1 text-xs font-semibold bg-orange-100 text-orange-700 rounded-full">
                                #3
                            </span>
                        @else
                            {{ $index + 1 }}
                        @endif
                    </td>

                    {{-- Nama --}}
                    <td class="px-6 py-4 font-medium text-blue-900">
                        {{ $row->user->name }}
                    </td>
                     <td class="px-6 py-4 text-gray-700">
                     {{ $row->user->kelas->nama_kelas ?? '-' }}
                    </td>

                    {{-- Total Kuis --}}
                    <td class="px-6 py-4 text-center text-gray-700">
                        {{ $row->total_quiz }}
                    </td>

                    {{-- Total Nilai --}}
                    <td class="px-6 py-4 text-right font-semibold text-blue-900">
                        {{ $row->total_score }}
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
        </main>
</div>

</x-app-layout>
