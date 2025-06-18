<div wire:poll.1ms>
    <x-slot name="header">
        <div class="text-2xl font-bold text-quiz-primary">
            PlayLearn
        </div>
        @livewire('components.atoms.end-session-button', ['sessionId' => $session->id])
    </x-slot>
    
    <div class="container mx-auto px-4 pt-16">
      <div class="max-w-4xl mx-auto">

        <!-- Tab Navigation -->
        <div class="flex justify-center mb-8">
          <div class="bg-black/20 rounded-lg p-1 inline-flex">
            <button class="px-6 py-2 rounded-lg bg-white/10 text-white">Classement</button>
          </div>
        </div>

        <!-- Leaderboard -->
        <div class="bg-black/20 backdrop-blur-sm rounded-xl p-6">
            <div class="flex items-center space-x-2 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span>{{ $session->players->count() }} participants</span>
            </div>

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
                <div class="bg-black/30 rounded-lg p-4">
                    <div class="grid grid-cols-12 gap-4 items-center">
                        <!-- Rang du joueur -->
                        <div class="col-span-1 font-medium">{{ $rank }}</div>

                        <!-- Nom + Avatar -->
                        <div class="col-span-7 flex items-center space-x-2">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                {{ strtoupper(substr($sessionJoueur->player_name, 0, 1)) }}
                            </div>
                            <span>{{  $sessionJoueur->player_name }}</span>
                        </div>

                        <!-- Score -->
                        <div class="col-span-4 flex justify-end items-center space-x-2">
                            <span>{{ number_format($sessionJoueur->getCash($cashParametre->id), 2, ',', ' ') }}</span>
                            <div class="w-4 h-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-euro-icon lucide-euro">
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

        @if ($message)
            <p class="p-2 text-red-500 text-xs italic">{{ $message }}</p>
        @endif
      </div>
    </div>
</div>