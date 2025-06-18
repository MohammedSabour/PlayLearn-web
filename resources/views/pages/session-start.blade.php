<div>
    <div class="max-w-7xl mx-auto">
        <!-- Breadcrumb and Start button -->
        <div class="flex justify-between items-center mb-12">
            <nav class="flex items-center gap-3 text-sm" aria-label="Breadcrumb">
                <button class="p-2 hover:bg-gray-100 rounded-full transition-colors" aria-label="Go back">
                    <a href="{{route('dashboard')}}">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                    </a>
                </button>
                <ol class="flex items-center">
                    <li class="flex items-center"><span class="text-gray-600">En direct</span></li>
                    <li class="flex items-center">
                        <span class="mx-2 text-gray-400">›</span><span class="text-gray-600">Digital Factory Challenge</span>
                    </li>
                </ol>
            </nav>
            <button  wire:click="startSession" class="flex items-center  bg-blue-500 hover:bg-blue-600 text-white py-3 px-5 text-base rounded-xl  font-semibold">
                Commencer
            </button>
        </div>

        <div x-data="{ mode: @entangle('mode') }" class="space-y-8 pt-20">
            <!-- Choix du mode -->
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-8 text-center">Mode Session</h2>
                <div class="flex justify-center gap-4 pb-4 flex-wrap">
                    <!-- Mode classique -->
                    <button 
                        @click="mode = 'solo'" 
                        :class="mode === 'solo' ? 'border-blue-500' : 'border-transparent'"
                        class="relative p-3 rounded-lg bg-white transition-all hover:shadow-md hover:-translate-y-0.5 border-2 w-[140px] text-center focus:outline-none"
                    >
                        <div class="absolute top-2 right-2 text-blue-500">
                            <svg x-show="mode === 'solo'" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 6L9 17l-5-5"/>
                            </svg>
                        </div>
                        <div class="mb-2">
                            <img src="/img/single_player.png" class="w-12 h-12 mx-auto" alt="Mode classique">
                        </div>
                        <h3 class="text-sm font-medium text-gray-900">Mode classique</h3>
                    </button>

                    <!-- Mode équipe -->
                    <button 
                        @click="mode = 'team'" 
                        :class="mode === 'team' ? 'border-blue-500' : 'border-transparent'"
                        class="relative p-3 rounded-lg bg-white transition-all hover:shadow-md hover:-translate-y-0.5 border-2 w-[140px] text-center focus:outline-none"
                    >
                        <div class="absolute top-2 right-2 text-blue-500">
                            <svg x-show="mode === 'team'" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 6L9 17l-5-5"/>
                            </svg>
                        </div>
                        <div class="mb-2">
                            <img src="/img/team_players.png" class="w-12 h-12 mx-auto" alt="Mode équipe">
                        </div>
                        <h3 class="text-sm font-medium text-gray-900">Mode équipe</h3>
                    </button>
                </div>
            </div>
        </div>

        <!-- Bloc Paramètres de session -->
        <div class="pt-8 flex justify-center">
            <div class="bg-white rounded-2xl shadow-lg p-6 space-y-8 w-full max-w-xl">
                <h2 class="text-xl font-semibold text-gray-900 mb-2">Paramètres de session</h2>
                <div class="space-y-4">
                    
                    <!-- Nombre de rounds -->
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium text-gray-700">Nombre de rounds</label>
                        <select wire:model="nombreRounds" class="w-44 rounded-md border border-gray-300 px-2 py-2 text-sm shadow">
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>

                    <!-- Options supplémentaires -->
                    <div class="flex flex-wrap gap-3 pt-2">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" wire:model="shuffle_questions" class="peer accent-blue-500 w-4 h-4 rounded border-gray-300 shadow"/>
                            <span class="text-sm font-medium text-gray-700">Mélanger les questions</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" wire:model="power_ups" class="peer accent-blue-500 w-4 h-4 rounded border-gray-300 shadow"/>
                            <span class="text-sm font-medium text-gray-700">Mises sous tension</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" wire:model="show_leaderboard" class="peer accent-blue-500 w-4 h-4 rounded border-gray-300 shadow"/>
                            <span class="text-sm font-medium text-gray-700">Montrer le classement</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

