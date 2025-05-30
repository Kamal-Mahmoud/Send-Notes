<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="overflow-y-hidden antialiased bg-gray-100">
    <div
        class="p-2 pr-10 font-bold bg-gray-100 bg-center bg sm:flex sm:justify-center sm:items-center bg-dots-darker dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <livewire:welcome.navigation />
        @endif

    </div>

        <div class="flex flex-col items-center justify-center min-h-screen mx-auto space-y-4 text-center bg-gray-100 ">
            <x-application-logo class="w-24 h-24 fill-current text-primary " />
            <x-button primary xl href="{{ route('register') }}">Get Started</x-button>
        </div>


</body>

</html>