<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ config('app.name', 'Laravel') }}">
    <meta name="keywords" content="Laravel, {{ config('app.name', 'Laravel') }}">
    <meta name="author" content="Your Name">

    <title>{{ __('AnimeHub') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Font Awesome (Version 6) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- App's JavaScript -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>


<body class="font-sans antialiased bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-gray-800">
    <div class="min-h-screen flex flex-col">
        
        <!-- Navigation -->
        @include('layouts.navigation') <!-- Including the navigation layout -->
        
        <!-- Page Heading -->
        <header class="bg-white shadow-lg p-4 sm:p-6 lg:p-8">
            <div class="container mx-auto text-center">
                <h1 class="text-4xl font-semibold text-gray-800">{{ $header }}</h1> <!-- Dynamic page heading -->
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 bg-gray-50 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{ $slot }} <!-- This is where dynamic content (e.g., views) will be injected -->
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-6">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} {{ __('AnimeHub') }}. All rights reserved.</p> <!-- Display the current year dynamically -->
            </div>
        </footer>
    </div>
</body>

</html>
