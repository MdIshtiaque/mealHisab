<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Meal Manager') }}</title>

    <!-- PWA  -->
    <meta name="theme-color" content="#4f46e5" />
    <meta name="description" content="A meal management system for tracking meals and expenses">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="MealMgr">

    <link rel="manifest" href="{{ asset('build/manifest.webmanifest') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="mask-icon" href="{{ asset('build/icons/icon-192x192.png') }}" color="#4f46e5">

    {{-- <link rel="icon" type="image/png" href="{{ asset('build/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('build/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('build/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('build/apple-touch-icon.png') }}" /> --}}
    <meta name="apple-mobile-web-app-title" content="MealMgr" />

    <link rel="stylesheet" href="{{ asset('build/assets/app-aa06debb.css') }}">

    <script src="{{ asset('build/assets/app-4db4c63a.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <!-- PWA Install Button -->
    <button id="pwa-install-button" onclick="window.installPWA()"
        class="hidden fixed bottom-4 right-4 z-50 bg-primary-600 text-white px-4 py-2 rounded-lg shadow-lg flex items-center space-x-2 hover:bg-primary-700 transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
        <span>Install App</span>
    </button>

    <div class="min-h-screen bg-gray-50">
        @yield('content')
    </div>
</body>

</html>
