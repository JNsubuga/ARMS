<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        <script src="//unpkg.com/alpinejs" defer></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                background-image: url('./img/bg.jpg');
                background-repeat: no-repeat;
                background-size:100%
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            <!-- Page Heading -->
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow flex">
                <img src="{{ asset('img/ARMS.jpg') }}" width="250">
                {{-- <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex relative"> --}}
                <div class="py-6 px-8 sm:px-6 lg:px-8 flex relative w-full">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex w-full">
                @include('layouts.partials.sidebar')
                {{ $slot }}
            </main>
            <x-flashMsg />
        </div>
    </body>
</html>
