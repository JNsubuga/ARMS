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
    <body>
        <div class="font-sans text-gray-900 antialiased">
            @include('layouts.guest-navigation') 
            
            <!-- Page Heading -->
            @if (!route('login'))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex relative">
                        {{ $header }}
                    </div>
                </header>
            @endif
            
            <!-- Page Content -->
            <main class="transperent flex w-full">
                @include('layouts.partials.guest-sidebar')
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
