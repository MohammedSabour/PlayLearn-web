<div">
    <div class="text-center mb-6">
        <span class="inline-block px-4 py-1 rounded-full bg-white/10 backdrop-blur-sm text-sm">
            {{ $simulation->titre }}
        </span>
    </div>

    <div class="text-center mb-12">
        <h1 class="text-2xl md:text-3xl font-medium">
            {{ $simulation->description }}
        </h1>
    </div>

    <div 
        x-data="{ 
            currentVal: 0, 
            minVal: 0, 
            maxVal: 100, 
            showResults: false,
            calcPercentage(min, max, val) {
                return (((val - min) / (max - min)) * 100).toFixed(0);
            },
            
            init() {
                const duration = 10_000; // 30 secondes
                const interval = 100; // chaque 100ms
                const steps = duration / interval;
                const stepValue = this.maxVal / steps;

                let progressInterval = setInterval(() => {
                    if (this.currentVal < this.maxVal) {
                        this.currentVal += stepValue;
                    } else {
                        this.currentVal = this.maxVal;
                        clearInterval(progressInterval);
                        $wire.Simulate(30, 8);
                        this.showResults = true;
                    }
                }, interval);
            }
        }"
        class="w-full"
    >
        <!-- Texte progression -->
        <div class="mb-2 flex items-center justify-between text-sm text-gray-700">
            <span>Progression</span>
            <span x-text="`${calcPercentage(minVal, maxVal, currentVal)}%`"></span>
        </div>

        <!-- Barre de progression -->
        <div class="w-full bg-gray-300 h-3 rounded-full overflow-hidden">
            <div class="bg-blue-600 h-full transition-all duration-100" 
                x-bind:style="`width: ${calcPercentage(minVal, maxVal, currentVal)}%`">
            </div>
        </div>

        <!-- Message affiché à la fin -->
        <div x-show="showResults" x-transition class="mt-6">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                produits fabriqués
                            </th>
                            <th scope="col" class="px-6 py-3">
                                produits vendus
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Produits en stock 
                            </th>
                            <th scope="col" class="px-6 py-3">
                                produits jetés
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $manufactured }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $sold }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $stock }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $scrapped }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nombre de pannes
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Durée totale des pannes (minutes)
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $breakdown_events  }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $total_breakdown_minutes  }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nombre total de cyberattaques
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nombre de cyberattaques réussies
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Durée totale des interruptions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $cyber_attacks_total  }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $cyber_attacks_success  }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $total_cyberattack_minutes  }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
