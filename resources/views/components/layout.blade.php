<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">
    @include('partials.sidebar')
    <flux:main>
        {{ $slot }}
    </flux:main>

    <flux:toast />

    @fluxScripts
</body>

</html>
