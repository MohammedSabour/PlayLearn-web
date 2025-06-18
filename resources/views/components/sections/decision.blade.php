<div>
    <div class="text-center mb-6">
        <span class="inline-block px-4 py-1 rounded-full bg-white/10 backdrop-blur-sm text-sm">
            {{ $decision->titre }}
        </span>
    </div>

    <div class="text-center mb-12">
        <h1 class="text-2xl md:text-3xl font-medium">
            {{ $decision->description }}
        </h1>
    </div>

    <div x-data="{ selectedChoiceId: null }">
        <div class="pt-12 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            @foreach ($choices as $choice)
                <button  @click="selectedChoiceId = {{ $choice->id }}" class="bg-white/5 hover:bg-white/10 border border-white/20 backdrop-blur-md rounded-2xl p-6 transition-all shadow-md">
                    <h2 class="text-xl font-semibold mb-2 text-center">{{ $choice->choice_text }}</h2>
                </button>
            @endforeach
        </div>
        @if(session()->has('sucsses'))
            <div class="text-center mt-4 text-green-400">
                {{ session('sucsses') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="text-center mt-4 text-red-400"> 
                {{ session('error') }}
            </div>
        @endif
        
        <div x-show="selectedChoiceId !== null" class="mt-8 bg-white/5 border border-white/10 p-6 rounded-xl">
            @foreach ($choices as $choice)
                <div x-show="selectedChoiceId === {{ $choice->id }}" x-transition>
                   <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                        @foreach ($choice->levels as $level)
                            <div class="bg-white/10 rounded-xl p-4 border border-white/10 shadow-md">
                                <div class="text-lg font-semibold mb-2">
                                    Niveau {{ $level->level }}
                                </div>
                                <p class="text-sm text-gray-300 mb-3">
                                    {{ $level->description }}
                                </p>
                                <div class="text-emerald-400 font-bold mb-4">
                                    💰 Coût : {{ $level->cout }} €
                                </div>
                                <button 
                                    wire:click="makeDecision({{ $choice->id }}, {{ $level->id }})"
                                    class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-2 px-4 rounded-lg transition"
                                >
                                    Investir
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>