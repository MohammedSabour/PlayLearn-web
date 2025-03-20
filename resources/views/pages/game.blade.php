<div>
    <x-slot name="header">
        <!-- Timer -->
        <div class="flex items-center space-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
            </svg>
            <span class="font-medium">{{ gmdate("i:s", $currentTime )}}</span>
        </div>
        
        <div class="absolute left-1/2 transform -translate-x-1/2 flex items-center space-x-1">
            @livewire('components.atoms.score-display', ['playerId' => $playerId, 'sessionId' => $sessionId,])
            <div class="w-4 h-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-flame">
                    <path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/>
                </svg>
            </div>
        </div>

        <div class="ml-auto flex items-center space-x-2">
            <div class="p-2">
                <span class="px-4 py-2 text-blue-400 font-mono text-sm mr-8 bg-white/10 rounded-xl backdrop-blur-md hover:bg-white/20 transition">
                    <span class="text-white">{{ $session->code_adhesion }}</span>
                </span>
            </div>
        </div>

        <button class="p-2 text-white hover:text-blue-400 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3"/>
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>
            </svg>
        </button>

        <button class="p-2 text-white hover:text-blue-400 transition-colors" id="fullscreen-btn">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/>
            </svg>
        </button>
    </x-slot>

    <!-- Main Content -->
    <div class="container mx-auto px-4">
      <div class="max-w-4xl mx-auto">

        <!-- Question Counter -->
        <div class="text-center mb-6">
            <span class="inline-block px-4 py-1 rounded-full bg-white/10 backdrop-blur-sm text-sm">
              {{ $currentIndex + 1 }} / {{ count($questions) }}
            </span>
        </div>

        <!-- Question -->
        <div class="text-center mb-12">
          <h1 class="text-2xl md:text-3xl font-medium">
            {{ $questions[$currentIndex]->question_text}}
          </h1>
        </div>

        <!-- Answer Options -->
        <div class="pt-12 grid grid-cols-1 md:grid-cols-4 gap-4">
          @php
              $colors = ['bg-blue-600 hover:bg-blue-700', 'bg-teal-600 hover:bg-teal-700', 'bg-orange-500 hover:bg-orange-600', 'bg-red-400 hover:bg-red-500'];
          @endphp

          @foreach ($questions[$currentIndex]->choices as $choice)
              <div class="{{ $colors[$loop->index] }} transition-colors rounded-xl p-8 cursor-pointer min-h-[200px] flex items-center justify-center"
                    wire:click="submitAnswer({{ $choice->id }})">
                  <p class="text-xl md:text-2xl font-medium text-center">
                      {{ $choice->choice_text }}
                  </p>
              </div>
          @endforeach
        </div>

        <!-- Message de fin -->
        @if(session()->has('message'))
            <div class="text-center mt-4 text-green-400">
                {{ session('message') }}
            </div>
        @endif
      </div>
    </div>

    <!-- Footer -->
    <div class="fixed bottom-0 left-0 right-0 p-4 ">
        <div class="container mx-auto">
            <div class="flex justify-between items-center">

                <!-- Left Side -->
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 lucide lucide-gamepad-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="6" x2="10" y1="11" y2="11"/>
                            <line x1="8" x2="8" y1="9" y2="13"/>
                            <line x1="15" x2="15.01" y1="12" y2="12"/>
                            <line x1="18" x2="18.01" y1="10" y2="10"/>
                            <path d="M17.32 5H6.68a4 4 0 0 0-3.978 3.59c-.006.052-.01.101-.017.152C2.604 9.416 2 14.456 2 16a3 3 0 0 0 3 3c1 0 1.5-.5 2-1l1.414-1.414A2 2 0 0 1 9.828 16h4.344a2 2 0 0 1 1.414.586L17 18c.5.5 1 1 2 1a3 3 0 0 0 3-3c0-1.545-.604-6.584-.685-7.258-.007-.05-.011-.1-.017-.151A4 4 0 0 0 17.32 5z"/>
                        </svg>
                        <span class="text-sm">{{ $player->name }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
