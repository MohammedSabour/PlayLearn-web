<div wire:poll.1ms>
    <x-slot name="header">
        <div class="text-2xl font-bold text-quiz-primary">
            PlayLearn
        </div>
        @livewire('components.atoms.end-session-button', ['sessionId' => $session->id])
    </x-slot>
    
    <div class="container mx-auto px-4 pt-24">
      <div class="max-w-4xl mx-auto">

        <!-- Progress Bar with Percentage -->
        <div class="relative mb-16">

          <div class="h-4 bg-black/30 rounded-full overflow-hidden">
            <div class="w-0 h-full bg-gradient-to-r from-emerald-400 to-emerald-500"></div>
          </div>

          <div class="absolute left-1/2 -translate-x-1/2 -bottom-14 bg-white/20 rounded-full p-4">
            <div class="text-center">
              <span class="text-2xl font-bold">0%</span>
              <p class="text-xs mt-1">Pourcentage de<br/>réponses de classe</p>
            </div>
          </div>
          
        </div>

        <!-- Tab Navigation -->
        <div class="flex justify-center mb-8">
          <div class="bg-black/20 rounded-lg p-1 inline-flex">
            <button class="px-6 py-2 rounded-lg bg-white/10 text-white">Classement</button>
            <button class="px-6 py-2 text-gray-400">Questions</button>
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
                <div class="col-span-4 text-right">Score</div>
            </div>

            @php
                $players = $session->players->sortByDesc('score');
                $rank = 1;
            @endphp

            @foreach($session->players as $player)
                <div wire:key="player-{{ $player->id }}" class="bg-black/30 rounded-lg p-4">
                    <div class="grid grid-cols-12 gap-4 items-center">
                        <!-- Rang du joueur -->
                        <div class="col-span-1 font-medium">{{ $rank }}</div>

                        <!-- Nom + Avatar -->
                        <div class="col-span-7 flex items-center space-x-2">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                {{ strtoupper(substr($player->name, 0, 1)) }}
                            </div>
                            <span>{{ $player->name }}</span>
                        </div>

                        <!-- Score -->
                        <div class="col-span-4 flex justify-end items-center space-x-2">
                            @foreach($session->scores as $score)
                                @if($score->id_user === $player->id)
                                  <span>{{ $score->score ?? 0}}</span>
                                @endif
                            @endforeach
                            <div class="w-4 h-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-flame">
                                    <path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/>
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
</div>
