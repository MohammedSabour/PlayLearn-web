<!-- Navigation Bar -->
<nav class="bg-white w-full p-4 flex justify-between items-center">
        <div class="flex items-center">
            <a  href="{{route('home')}}" class="text-3xl font-bold text-blue-light">PlayLearn</a>
        </div>

        <div class="flex space-x-3">
            <button class="hidden md:inline-flex btn-secondary"><a href="{{ route('join') }}">Entrez le code</a><button>
            @guest
                <a href="{{ route('login') }}" class="hidden sm:inline-flex btn-secondary">Connexion</a>
                <a href="{{ route('register')}}" class="btn-primary">S'inscrire</a>
            @endguest
        </div>
</nav>