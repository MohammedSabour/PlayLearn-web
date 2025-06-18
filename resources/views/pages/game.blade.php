<div wire:poll.keep-alive="checkStatus"
    x-data="{
            showGameInfo: true,
            showQuiz: false,
            showDecision: false,
            showSimulation: false,

            currentRound: 1,
            totalRounds: @entangle('nb_rounds'),
            
            timer: null,
            totalTime: 0,
            timeLeft: 0,

            durations: {
                quiz: 60,
                decision: 45,
                simulation: 30,
            },
            
            startTimer(duration, callback) {
                clearInterval(this.timer);
                this.timeLeft = duration;
                this.totalTime = duration;
                this.timer = setInterval(() => {
                    this.timeLeft--;
                    if (this.timeLeft <= 0) {
                        clearInterval(this.timer);
                        callback();
                    }
                }, 1000);
            },

            startQuiz() {
                this.showGameInfo = false;
                this.showQuiz = true;
                this.startTimer(this.durations.quiz, () => $wire.dispatch('qcmFinished'));
            },

            startDecision() {
                this.showDecision = true;
                this.showSimulation = false;
                this.startTimer(this.durations.decision, () => $wire.dispatch('decisionFinished'));
            },

            startSimulation() {
                this.showDecision = false;
                this.showSimulation = true;
                this.startTimer(this.durations.simulation, () => $wire.dispatch('simulationFinished'));
            },

            nextRound() {
                if (this.currentRound < this.totalRounds) {
                    this.currentRound++;
                    this.startDecision();
                } else {
                    $wire.dispatch('gameFinished');
                    this.showSimulation = false;
                }
            }
        }"

        x-init=" 
            setTimeout(() => startQuiz(), 3000);

            $wire.on('qcmFinished', () => {
                showQuiz = false;
                startDecision();
            });

            $wire.on('decisionFinished', () => {
                startSimulation();
            });

            $wire.on('simulationFinished', () => {
                nextRound();
            });
        "
>
    <x-slot name="header">        
        <div class="absolute left-1/2 transform -translate-x-1/2 flex items-center space-x-1">
            @livewire('components.atoms.score-display', ['playerId' => $playerId, 'sessionId' => $sessionId,])
            <div class="w-4 h-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-euro-icon lucide-euro">
                    <path d="M4 10h12"/>
                    <path d="M4 14h9"/>
                    <path d="M19 6a7.7 7.7 0 0 0-5.2-2A7.9 7.9 0 0 0 6 12c0 4.4 3.5 8 7.8 8 2 0 3.8-.8 5.2-2"/>
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
    <div>   
        <!-- Affichage des informations du jeu -->
        <div x-show="showGameInfo" class="absolute inset-0 flex flex-col justify-center items-center text-white bg-black/50 py-4 text-center">
            <div class="container mx-auto">
                <h2 class="text-2xl font-semibold mb-1">{{ $game->titre }}</h2>
                <p class="text-xl">{{ $game->description }}</p>
            </div>
        </div>

        <!-- Affichage du quiz -->
        <div x-show="showQuiz" x-cloak>
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <livewire:components.sections.qcm 
                        :sessionId="$sessionId" 
                        :playerId="$playerId" 
                        :quizId="$quizId" 
                        wire:key="qcm-{{ $sessionId }}-{{ $playerId }}" 
                    />
                </div>
            </div>
        </div>

        <!-- Affichage du Décision après le Quiz -->
        <div x-show="showDecision" x-cloak>
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <div class="text-xl font-bold text-center mb-4">
                        Round <span x-text="currentRound"></span> / <span x-text="totalRounds"></span>
                    </div>
                    <livewire:components.sections.decision 
                        :sessionId="$sessionId" 
                        :playerId="$playerId" 
                        :decisionId="$decisionId" 
                        wire:key="decision-{{ $sessionId }}-{{ $playerId }}" 
                    />             
                </div>
            </div>
        </div>

        <!-- Affichage du Simulation après le Décision -->
        <div x-show="showSimulation">
            @if ($showSimulation)
                <div class="container mx-auto px-4">
                    <div class="max-w-4xl mx-auto">
                        <livewire:components.sections.simulation 
                            :sessionId="$sessionId" 
                            :playerId="$playerId" 
                            :simulationId="$simulationId" 
                            wire:key="simulation-{{ $sessionId }}-{{ $playerId }}" 
                        />
                    </div>
                </div>
            @endif
        </div>
    </div>

    <footer class="fixed bottom-0 left-0 right-0 p-4 ">
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

                    <!-- Right Side -->
                    <div class="flex items-center space-x-1" x-show="timeLeft > 0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                        <span class="font-medium" 
                            x-text="`${Math.floor(timeLeft / 60)}:${String(timeLeft % 60).padStart(2, '0')}`">
                        </span>
                    </div>
                </div>
            </div>
    </footer>
</div>