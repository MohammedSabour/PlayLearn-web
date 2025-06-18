<div class="container mx-auto px-4 pt-16">
    <div class="max-w-4xl mx-auto">
        <div class="bg-black/20 backdrop-blur-sm rounded-xl p-6">
            <!-- Table players -->
            <div class="grid grid-cols-12 gap-4 text-sm text-gray-400 mb-4 px-4">
                <div class="col-span-1">Rang</div>
                <div class="col-span-7">Nom</div>
                <div class="col-span-4 text-right">Cash</div>
            </div>
            @php
                $rank = 1;
            @endphp

            @foreach($this->sortedSessionJoueurs as $sessionJoueur)
                @php
                    $isCurrentPlayer = $this->currentSessionJoueur->id === $sessionJoueur->id;
                @endphp

                <div class="rounded-lg p-4 {{ $isCurrentPlayer ? 'ring-2 ring-blue-400' : ''  }}">
                    <div class="grid grid-cols-12 gap-4 items-center">
                        <!-- Rang du joueur -->
                        <div class="col-span-1 font-medium">{{ $rank }}</div>

                        <!-- Nom + Avatar -->
                        <div class="col-span-7 flex items-center space-x-2">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                {{ strtoupper(substr($sessionJoueur->player_name, 0, 1)) }}
                            </div>
                            <span>{{ $sessionJoueur->player_name }}</span>
                        </div>

                        <!-- Score -->
                        <div class="col-span-4 flex justify-end items-center space-x-2">
                            <span>{{ number_format($sessionJoueur->getCash($cashParametre->id), 2, ',', ' ') }}</span>
                            <div class="w-4 h-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="lucide lucide-euro-icon lucide-euro">
                                    <path d="M4 10h12"/>
                                    <path d="M4 14h9"/>
                                    <path d="M19 6a7.7 7.7 0 0 0-5.2-2A7.9 7.9 0 0 0 6 12c0 4.4 3.5 8 7.8 8 2 0 3.8-.8 5.2-2"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $rank++;
                @endphp
            @endforeach
        </div>
    </div>
</div>
