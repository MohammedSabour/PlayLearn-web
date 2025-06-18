<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        <title>{{ config('app.name', 'PlayLearn') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50">
            <!-- Page Heading -->
            @if (isset($header))
                <header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 ease-in-out py-4 bg-white">
                    {{ $header }}
                </header>
            @endif

            <!-- Page Content -->
            <main class="pt-8">
                {{ $slot }}
            </main>
        </div>
        @livewireScripts
    </body>
</html>
