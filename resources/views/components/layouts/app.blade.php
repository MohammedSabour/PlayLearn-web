<div>
    {{-- Do your work, then step back. --}}
</div>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PlayLearn</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white">
    <livewire:components.organismes.nav-bar />
    {{ $slot }}

    @livewireScripts
</body>
</html>
