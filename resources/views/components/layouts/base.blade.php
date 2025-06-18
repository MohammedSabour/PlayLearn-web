<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PlayLearn</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <!-- Page Heading -->
    @if (isset($header))
        <header class="fixed top-0 left-0 right-0 p-4 glass animate-fade-in z-50">
            <div class="container mx-auto flex justify-between items-center">
                {{ $header }}
            </div>
        </header>
    @endif

    <main class="pt-32">
        {{ $slot }} 
    </main>

    @livewireScripts
</body>
</html>
