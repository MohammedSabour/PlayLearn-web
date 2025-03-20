<x-app-layout>
    <x-slot name="header">
        <div class="container max-w-7xl mx-auto px-4 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center gap-8">
                <a href="{{route('join')}}" class="font-bold text-2xl text-brand text-[#1b37b2] tracking-tight transition-all duration-300 hover:opacity-90">
                    PlayLearn
                </a>

                <!-- Search Bar -->
                <div class="flex items-center gap-2 px-4 py-2 bg-gray-100 rounded-full transition-all duration-300 hover:bg-gray-200">
                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-line join="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" placeholder="Trouver un jeu" class="h-4 bg-transparent border-none outline-none w-full text-sm placeholder:text-gray-400">
                </div>
            </div>

            <!-- Navigation Items -->
            <nav class="hidden md:flex items-center gap-4">
                <a href="/" class="nav-item active">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Accueil</span>
                </a>
                <a href="" class="nav-item">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span>Activité</span>
                </a>
            </nav>

            <!-- Create Quiz Button -->
            <div class="flex items-center gap-4">
                <a href="{{ route('filament.admin.resources.quizzes.create') }}"
                    class="flex items-center gap-2 px-4 py-2 bg-[#3776fa] text-white font-medium rounded-full transition-all duration-300 hover:bg-[#a4caff]">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Créer un jeu
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
            </div>
        </div>
    </div>
</x-app-layout>
