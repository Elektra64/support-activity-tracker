<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Support Activity Tracker</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen flex flex-col">
            <!-- Header -->
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Support Activity Tracker</h1>
                    @if (Route::has('login'))
                        <div class="flex gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-grow max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Welcome Section -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Welcome to Support Activity Tracker</h2>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            Track and manage your support team's activities efficiently. Monitor performance, analyze trends, and improve customer satisfaction.
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">Real-time activity tracking</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">Performance analytics</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">Team collaboration tools</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white dark:bg-gray-800 shadow mt-8">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <p class="text-center text-gray-500 dark:text-gray-400">
                        © {{ date('Y') }} Support Activity Tracker. All rights reserved.
                    </p>
                </div>
            </footer>
        </div>
    </body>
</html>
