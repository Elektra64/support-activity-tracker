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

        <!-- Tailwind CSS -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

      
    </head>
    <body class="font-sans antialiased">
    
       <div class="min-h-screen bg-gray-100">
            @if(session('success'))
                <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    {{ session('success') }}
                </div>
                <script>
                    setTimeout(function() {
                        document.getElementById('success-alert').style.opacity = '0';
                        document.getElementById('success-alert').style.transition = 'opacity 1s';
                        setTimeout(function() {
                            document.getElementById('success-alert').remove();
                        }, 1000);
                    }, 3000);
                </script>
            @endif
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset
            <!-- Page Content -->
            <main>
                <div class="min-h-screen bg-gray-900 text-white">
                    @yield('content', $slot ?? '')
                </div>
            </main>
            </main>
        </div>
        
    </body>
</html>
