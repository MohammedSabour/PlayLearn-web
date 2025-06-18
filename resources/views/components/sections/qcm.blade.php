<div>
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
    
    @if($questions[$currentIndex]->type->value == 'qcu')
        <!-- QCU Answer Options -->
        <div class="pt-12 grid grid-cols-1 md:grid-cols-4 gap-4">
            @php
                $colors = ['bg-blue-600 hover:bg-blue-700', 'bg-teal-600 hover:bg-teal-700', 'bg-orange-500 hover:bg-orange-600', 'bg-red-400 hover:bg-red-500'];
            @endphp

            @foreach ($questions[$currentIndex]->choices as $choice )
                <div wire:key="choice-{{ $choice->id }}" class="{{ $colors[$loop->index] }} transition-colors rounded-xl p-8 cursor-pointer min-h-[200px] flex items-center justify-center"
                    wire:click="submitAnswer({{ $choice->id }})">
                    <p class="text-xl md:text-2xl font-medium text-center">
                        {{ $choice->choice_text }}
                    </p>
                </div>
            @endforeach
        </div>

    @elseif($questions[$currentIndex]->type->value == 'qcm')
        <!-- QCM Answer Options -->
        <div class="bg-black/40 rounded-full px-6 py-2 mb-8 text-center">
            <span>Sélectionnez toutes les options correctes</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 w-full max-w-5xl mb-12">
            @php
                $colors = [
                    'bg-gradient-to-br from-blue-600 to-blue-800', 
                    'bg-gradient-to-br from-teal-500 to-teal-700', 
                    'bg-gradient-to-br from-orange-400 to-orange-600', 
                    'bg-gradient-to-br from-pink-500 to-pink-600'
                ];
            @endphp
            
            @foreach ($questions[$currentIndex]->choices as $choice)
                <div wire:key="choice-{{ $choice->id }}" class="relative">
                    <!-- Checkbox avec wire:model -->
                    <input type="checkbox" id="option{{ $choice->id }}"  wire:model="selectedChoices" value="{{ $choice->id }}" class="peer absolute opacity-0 h-0 w-0">
                    <label for="option{{ $choice->id }}" 
                        class="block {{ $colors[$loop->index] }} rounded-xl p-6 h-64 flex flex-col items-center justify-center text-center cursor-pointer peer-checked:ring-4 peer-checked:ring-white">
                        <span class="text-2xl">{{ $choice->choice_text }}</span>
                    </label>
                </div>
            @endforeach
        </div>
      
        <!-- Submit Button -->
        <div class="fixed bottom-24 right-8">
            <button wire:click="submitQCM" class="bg-white rounded-xl text-gray-800 font-medium px-8 py-3 hover:bg-gray-100 transition-colors">
                Soumettre
            </button>
        </div>
    @else
        <p>No choice Answer.</p>
    @endif
</div>