<x-app-layout>
    <x-slot name="header">
        <div class="container max-w-7xl mx-auto px-4 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center gap-8">
                <a href="{{route('join')}}" class="font-bold text-2xl text-brand text-[#1b37b2] tracking-tight transition-all duration-300 hover:opacity-90">
                    PlayLearn
                </a>
            </div>

            <!-- Create Quiz Button -->
            <div class="flex items-center gap-4">
                <a href="{{ route('session.start') }}"
                    class="flex items-center gap-2 px-4 py-2 bg-[#3776fa] text-white font-medium rounded-full transition-all duration-300 hover:bg-[#a4caff]">
                    New session 
                </a>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center justify-center w-8 h-8 bg-[#3776fa] text-white rounded-full transition duration-300 hover:bg-[#a4caff] hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <line x1="4" x2="20" y1="12" y2="12"/>
                                <line x1="4" x2="20" y1="6" y2="6"/>
                                <line x1="4" x2="20" y1="18" y2="18"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ Auth::user()->name }}
                            </div>

                            <div class="border-t border-gray-200"></div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Paramètres') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Se déconnecter') }}
                                </x-dropdown-link>
                            </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </x-slot>

    <div class="pt-32 px-4 pb-16">
        <div class="max-w-7xl mx-auto">
            <!-- Home Page Content -->
            <section class="mt-12 text-center animate-fade-in">
                <h1 class="text-4xl md:text-5xl font-bold tracking-tight text-gray-900">
                    Bienvenue {{ Auth::user()->name }}
                </h1>
                <p class="mt-8 text-xl text-gray-600 max-w-3xl mx-auto">
                     Lancez une session de jeu du <strong>Digital Factory Challenge</strong> et collaborez avec les joueurs en temps réel.
                </p>
            
                <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('session.start') }}" class="px-6 py-3 text-lg bg-[#3776fa] text-white font-medium rounded-full transition-all duration-300 hover:bg-[#2562b7]"> Lencer une partie </a>
                    <button class="px-6 py-3 text-lg border border-gray-300 rounded-full text-gray-700 hover:bg-gray-100 transition-all duration-300">
                        Découvrir notre jeu
                    </button>
                </div>
            </section>
        </div>
    </div>  
</x-app-layout>