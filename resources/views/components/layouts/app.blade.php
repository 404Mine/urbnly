<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Urbnly' }}</title>
        <link rel="icon" href="{{ asset('storage/urbnlyicontransparent.png') }}">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/customcss/addedoutput.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/app-BsN5kOcC.css') }}">
        <script src="{{ asset('build/assets/app-DkDdL2UM.js') }}"></script>
        @livewireStyles
    </head>
    <body class="bg-[#1E1F22]">
        {{ $slot }}
        @livewireScripts

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
        <x-livewire-alert::scripts />
    </body>
</html>
