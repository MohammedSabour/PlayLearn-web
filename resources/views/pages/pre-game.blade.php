<div>
    <x-slot name="header">
        <div class="flex items-center space-x-1">
            <!-- Bouton retour -->
            <button wire:click="redirectToJoin" class="inline-flex items-center px-2 py-2 text-white bg-white/10 rounded-xl backdrop-blur-md hover:bg-white/20 transition">
              <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-palette w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M18 6 6 18"/>
                  <path d="m6 6 12 12"/>
              </svg>
            </button>

            <!-- Bouton thème -->
            <button class="inline-flex items-center px-4 py-2 text-white bg-white/10 rounded-xl backdrop-blur-md hover:bg-white/20 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-palette w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="13.5" cy="6.5" r=".5" fill="currentColor"/>
                    <circle cx="17.5" cy="10.5" r=".5" fill="currentColor"/>
                    <circle cx="8.5" cy="7.5" r=".5" fill="currentColor"/>
                    <circle cx="6.5" cy="12.5" r=".5" fill="currentColor"/>
                    <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z"/>
                </svg>
                Thème
            </button>
        </div>

        <div class="ml-auto flex items-center space-x-2">
            <div class="p-2">
                <span class="px-4 py-2 text-blue-400 font-mono text-sm mr-8 bg-white/10 rounded-xl backdrop-blur-md hover:bg-white/20 transition">
                    <span class="text-white">{{ $session->code_adhesion }}</span>
                </span>
            </div>
        </div>
    </x-slot>
    
    <!-- Main Content -->
    <div class="container mx-auto px-4">
      <div class="max-w-md mx-auto space-y-6">
        <!-- Game Setup Card -->
        <div class="bg-white/10 backdrop-blur-md border border-white/20 shadow-lg p-8 rounded-2xl animate-[fadeIn_0.3s_ease-out]">
          <div class="space-y-6">
            <!-- Name Input -->
            <div class="space-y-2">
              <label class="block text-gray-300 text-sm mb-1">Your name in PlayLearn</label>
              <input
                wire:model="player_name" 
                type="text" 
                class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:outline-none focus:border-white/40"
                placeholder="Enter your name"
              />
              @if (session('error'))
                <p class="text-red-500 text-xs italic">{{ session('error') }}</p>
              @endif
            </div>
            <!-- Start Button -->
            <button wire:click="confirmPlayer" class="w-full py-4 bg-emerald-400 hover:bg-emerald-500 text-white font-medium rounded-lg transition-colors">
              Commencer
            </button>

            <!-- Settings -->
            <div class="space-y-4 mt-8">
              <h3 class="text-lg font-medium text-white mb-4">Paramètres</h3>
              
              <!-- Text to Speech Toggle -->
              <div class="flex items-center justify-between p-3 bg-white/10 backdrop-blur-md rounded-lg">
                <div class="flex items-center space-x-3">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M17.536 6.464a9 9 0 010 11.072m-8-14.072a5 5 0 010 7.072M5.536 6.464a9 9 0 010 11.072"/>
                  </svg>
                  <span>Lire le texte à haute voix</span>
                </div>
                <label class="switch">
                  <input type="checkbox">
                  <span class="slider"></span>
                </label>
              </div>

              <!-- Sound Effects Toggle -->
              <div class="flex items-center justify-between p-3 bg-white/10 backdrop-blur-md rounded-lg">
                <div class="flex items-center space-x-3">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                  </svg>
                  <span>Effets sonores</span>
                </div>
                <label class="switch">
                  <input type="checkbox" checked>
                  <span class="slider"></span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
