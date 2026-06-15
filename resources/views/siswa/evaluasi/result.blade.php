<x-app-layout>
    <div class="flex">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        <main class="flex-1 ml-0 lg:ml-64 p-4 sm:p-6 lg:p-8 space-y-8 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">

            @php
            $score = $score ?? 0;
            $correct = $correct ?? 0;
            $total = $total ?? 0;

            $color = $score >= 80 ? 'blue' : ($score >= 70 ? 'green' : ($score >= 50 ? 'yellow' : 'red'));

            if($score >= 80){
            $badge = "Excellent";
            $message = "Luar biasa! Kamu sangat menguasai materi.";
            } elseif($score >= 70){
            $badge = "Good Job";
            $message = "Bagus! Pertahankan semangat belajarmu.";
            } elseif($score >= 50){
            $badge = "Keep Improving";
            $message = "Lumayan! Tingkatkan lagi ya.";
            } else {
            $badge = "Keep Trying";
            $message = "Jangan menyerah, pelajari materi lagi.";
            }
            @endphp

            <div class="max-w-sm mx-auto">

                {{-- CARD UTAMA --}}
                <div class="bg-white/90 backdrop-blur-md 
                        border border-gray-200 
                        rounded-2xl shadow-lg 
                        p-6 text-center
                        transition-all duration-300
                        hover:shadow-2xl hover:scale-[1.02]">

                    {{-- SCORE CIRCLE --}}
                    <div class="flex justify-center mb-6">
                        <div class="w-32 h-32 rounded-full 
                        flex flex-col items-center justify-center
                        border-4
                        transition-all duration-300
                        hover:rotate-2 hover:scale-105

                        {{ $color == 'blue' ? 'border-blue-200 bg-blue-50 text-blue-600 shadow-blue-100' : '' }}
                        {{ $color == 'green' ? 'border-green-200 bg-green-50 text-green-600 shadow-green-100' : '' }}
                        {{ $color == 'yellow' ? 'border-yellow-200 bg-yellow-50 text-yellow-600 shadow-yellow-100' : '' }}
                        {{ $color == 'red' ? 'border-red-200 bg-red-50 text-red-600 shadow-red-100' : '' }}">

                            <p class="text-xs text-gray-500">Nilai</p>

                            <h2 class="text-3xl font-extrabold tracking-tight">
                                {{ $score }}
                            </h2>

                            <p class="text-[10px] text-gray-400">/ 100</p>
                        </div>
                    </div>

                    {{-- SUMMARY (SIMPLIFIED) --}}
                    <div class="bg-gray-50/80 border border-gray-200 
                            rounded-xl p-4 mb-5 text-sm text-center">

                        <p class="font-semibold text-gray-700">
                            Hasil Kamu
                        </p>

                        <p class="text-gray-600 mt-2">
                            Skor kamu:
                            <span class="font-bold text-gray-800">{{ $score }}</span>
                        </p>

                    </div>

                    {{-- BADGE --}}
                    <h3 class="text-base font-bold tracking-wide
                    transition-all duration-300
                    {{ $color == 'blue' ? 'text-blue-600' : '' }}
                    {{ $color == 'green' ? 'text-green-600' : '' }}
                    {{ $color == 'yellow' ? 'text-yellow-600' : '' }}
                    {{ $color == 'red' ? 'text-red-600' : '' }}">
                        {{ $badge }}
                    </h3>

                    <p class="text-gray-600 mt-2 text-xs leading-relaxed">
                        {{ $message }}
                    </p>

                    {{-- MINI GAME BUTTON --}}
                    @if($score < 70)
                        <div class="mt-6">

                        <div class="bg-gradient-to-r from-indigo-500 to-blue-500
                            rounded-2xl p-4 text-white shadow-lg
                            border border-indigo-200 relative overflow-hidden">

                            <div class="absolute -top-8 -right-8 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>

                            <div class="relative z-10">

                                <div class="flex items-center justify-center gap-2 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 text-yellow-300"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                                    </svg>

                                    <h4 class="font-bold text-sm">
                                        Refresh Dulu Yuk 😄
                                    </h4>
                                </div>

                                <button onclick="openGame()"
                                    class="w-full py-2.5 rounded-xl
                                        bg-white text-indigo-600
                                        font-semibold text-sm
                                        hover:scale-[1.02]
                                        active:scale-95
                                        transition-all duration-200
                                        shadow-md">
                                    Main Permainan
                                </button>

                            </div>
                        </div>
                </div>
                @endif

                {{-- BUTTON --}}
                <div class="mt-6 flex justify-center">
                    <a href="{{ route('siswa.evaluasi.index') }}"
                        class="inline-flex items-center gap-2
                                   px-5 py-2 text-xs font-medium
                                   bg-white border border-gray-300
                                   text-gray-600
                                   rounded-full
                                   shadow-sm
                                   hover:bg-gray-100 hover:shadow-md
                                   active:scale-95
                                   transition-all duration-200">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            class="w-4 h-4">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 18l-6-6 6-6" />
                        </svg>

                        Kembali
                    </a>
                </div>

            </div>

    </div>

    </main>
    </div>

    {{-- MINI GAME --}}
    @if($score < 70)

        <div id="gameModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4">

        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden border border-gray-200">

            <div class="bg-gradient-to-r from-indigo-500 to-blue-500 p-4 text-white flex justify-between items-center">
                <div>
                    <h2 class="font-bold text-lg">Catch The Code</h2>
                    <p class="text-xs text-blue-100">Tangkap codingan & hindari virus ☠️</p>
                </div>

                <button onclick="closeGame()" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white/30">
                    ✕
                </button>
            </div>

            <div class="px-4 py-3 flex justify-between items-center bg-gray-50 border-b">
                <div class="text-sm font-semibold text-gray-700">
                    Score: <span id="gameScore" class="text-indigo-600">0</span>
                </div>
                <div class="text-xs text-gray-500">Hindari Virus 💀</div>
            </div>

            <div id="gameArea"
                class="relative w-full h-[450px] bg-gradient-to-b from-slate-900 to-indigo-950 overflow-hidden">

                <div id="player"
                    class="absolute bottom-4 left-1/2 -translate-x-1/2 text-4xl transition-all duration-75">
                    💻
                </div>

            </div>

            <div class="p-3 text-center text-xs text-gray-500">
                Gerakkan mouse / sentuh layar untuk menangkap codingan
            </div>

        </div>
        </div>

        <script>
            let gameInterval;
            let scoreGame = 0;

            function openGame() {
                document.getElementById('gameModal').classList.remove('hidden');
                document.getElementById('gameModal').classList.add('flex');
                startGame();
            }

            function closeGame() {
                document.getElementById('gameModal').classList.add('hidden');
                document.getElementById('gameModal').classList.remove('flex');

                clearInterval(gameInterval);
                document.querySelectorAll('.falling-item').forEach(el => el.remove());

                scoreGame = 0;
                document.getElementById('gameScore').innerText = 0;
            }

            const gameArea = document.getElementById('gameArea');
            const player = document.getElementById('player');

            gameArea?.addEventListener('mousemove', (e) => {
                const rect = gameArea.getBoundingClientRect();
                let x = e.clientX - rect.left;
                player.style.left = `${x}px`;
            });

            gameArea?.addEventListener('touchmove', (e) => {
                const rect = gameArea.getBoundingClientRect();
                let x = e.touches[0].clientX - rect.left;
                player.style.left = `${x}px`;
            });

            function startGame() {
                clearInterval(gameInterval);
                gameInterval = setInterval(createFallingItem, 700);
            }

            function createFallingItem() {
                const item = document.createElement('div');
                const isVirus = Math.random() < 0.3;

                const symbols = ['if()', '{}', '</>', 'for{}', 'while', 'print()', 'var', 'array[]'];

                item.innerText = isVirus ? '☠️' : symbols[Math.floor(Math.random() * symbols.length)];
                item.className = 'falling-item absolute text-white font-bold text-lg';
                item.style.left = Math.random() * 85 + '%';
                item.style.top = '-30px';

                gameArea.appendChild(item);

                let topPos = -30;

                const fall = setInterval(() => {
                    topPos += 5;
                    item.style.top = topPos + 'px';

                    const itemRect = item.getBoundingClientRect();
                    const playerRect = player.getBoundingClientRect();

                    if (
                        itemRect.bottom >= playerRect.top &&
                        itemRect.left < playerRect.right &&
                        itemRect.right > playerRect.left
                    ) {
                        if (!isVirus) scoreGame += 1;
                        else scoreGame = Math.max(0, scoreGame - 1);

                        document.getElementById('gameScore').innerText = scoreGame;

                        item.remove();
                        clearInterval(fall);
                    }

                    if (topPos > 500) {
                        item.remove();
                        clearInterval(fall);
                    }

                }, 30);
            }
        </script>

        @endif

</x-app-layout>