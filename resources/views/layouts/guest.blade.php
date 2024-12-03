<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100">
        <div class="min-h-screen flex items-center">
            <!-- Left Section (Form) -->
            <div class="w-full flex flex-col justify-center items-center bg-gray-100 light:bg-gray-900 p-8">
                <h1 class="text-4xl font-bold mb-4 text-gray-800 light:text-gray-100">HERMES</h1>
                <div class="w-full sm:max-w-md px-6 py-4 bg-white light:bg-gray-800 shadow-md rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
