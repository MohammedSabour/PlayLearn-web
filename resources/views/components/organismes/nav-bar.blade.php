<nav class="fixed top-0 left-0 right-0 bg-white/90 backdrop-blur-sm z-50 border-b">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <a href="{{route('home')}}" class="text-2xl font-bold text-[#1b37b2]">PlayLearn</a>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                {{-- <a href="#" class="text-[#1A1F2C] hover:text-[#9b87f5] transition-colors">Ressources</a> --}}
            </div>

            <div class="flex items-center space-x-4">
                <button class="bg-white text-[#1b37b2] hover:bg-[#eff5ff] px-4 py-2 rounded-md">
                    <a href="{{ route('join') }}">Entrez le code</a>
                </button>
                @guest
                    <button class="bg-[#eff5ff] text-[#1b37b2] hover:bg-[#dae8ff] px-4 py-2 rounded-md">
                        <a href="{{ route('login') }}">Connexion</a>
                    </button>
                    <button class="bg-[#3776fa] hover:bg-[#a4caff] text-white px-4 py-2 rounded-md">
                        <a href="{{ route('register')}}">S'inscrire</a>
                    </button>
                @endguest
            </div>
        </div>
    </div>
</nav>
