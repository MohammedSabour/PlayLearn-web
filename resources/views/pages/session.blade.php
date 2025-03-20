<div wire:poll.1ms>
    <x-slot name="header">
        <div class="text-2xl font-bold text-quiz-primary">
            PlayLearn
        </div>
        @livewire('components.atoms.end-session-button', ['sessionId' => $session->id])
    </x-slot>

    <div class="flex-1 container max-w-4xl mx-auto p-4">
        <div class="quiz-gradient rounded-2xl p-6 md:p-8 space-y-8 shadow-xl">
            <!-- Join Code Section -->
            <div class="space-y-6">
                <div class="space-y-2 text-center">
                    <h2 class="text-2xl font-semibold tracking-tight text-white">
                        Rejoignez-nous en utilisant n'importe quel appareil
                    </h2>
                    <p class="text-sm text-muted-foreground">
                        Entrez le code ci-dessous pour rejoindre la session
                    </p>
                </div>
                <div class="bg-quiz-dark p-6 rounded-xl shadow-lg space-y-4">
                    <div class="text-center space-y-2">
                        <p class="text-sm font-medium text-muted-foreground">
                            Code d'adhésion
                        </p>
                        <div class="flex items-center justify-center gap-2">
                            <div class="text-4xl md:text-5xl font-bold tracking-wider text-quiz-primary">
                                {{ $session->code_adhesion }}
                            </div>
                            <button onclick="copyToClipboard('{{ $session->code_adhesion }}')" class="p-2 hover:bg-quiz-light rounded-lg transition-colors" title="Copier le code">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-muted-foreground">
                                    <rect width="14" height="14" x="8" y="8" rx="2" ry="2"/>
                                    <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Participants List -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 text-muted-foreground">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    <span class="text-sm font-medium">En attente des participants...</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($session->players as $player)
                        <div class="bg-quiz-dark p-4 rounded-lg flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-quiz-primary flex items-center justify-center font-semibold text-white">
                                {{ strtoupper(substr($player->name, 0, 1)) }}
                            </div>
                            <span class="font-medium text-white">{{ $player->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Action Buttons -->
            <div class="flex flex-col gap-4">
                <button wire:click="startGame" class="w-full bg-quiz-primary text-white py-4 px-8 rounded-xl font-semibold hover:opacity-90 transition-opacity">
                    COMMENCEZ MAINTENANT
                </button>
                @if ($errorMessage)
                    <p class="p-2 text-red-500 text-xs italic">{{ $errorMessage }}</p>
                @endif
                <!-- <div class="text-center">
                    <button class="text-sm text-muted-foreground hover:text-white transition-colors">
                        Partager via...
                    </button>
                </div> -->
            </div>
        </div>
    </div>
</div>