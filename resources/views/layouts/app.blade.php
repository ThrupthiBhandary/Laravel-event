<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'My Event Calendar App') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles from pages -->
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-800">
    <div class="min-h-screen flex flex-col">

        <!-- Top Navigation -->
        <nav class="bg-teal-600 text-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <!-- Logo/Title -->
                    <div class="flex items-center space-x-2">
                        <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a2 2 0 012 2v2h4a2 2 0 012 2v10a2 2 0 01-2 2h-4v-2h4V8h-4v2a2 2 0 01-2 2H6v6H4a2 2 0 01-2-2V8a2 2 0 012-2h4V4a2 2 0 012-2z" />
                        </svg>
                        <span>PlanWise</span>
                        <!-- <span class="font-semibold text-lg">{{ config('app.name', 'Calendar App') }}</span> -->
                    </div>

                    <!-- Navigation Links -->
                    <div class="space-x-6 hidden sm:flex">
                          <a href="{{ route('home') }}" class="hover:text-gray-200 {{ request()->routeIs('home') ? 'underline font-bold' : '' }}">
        Home
    </a>
                        <!-- <a href="{{ route('dashboard') }}" class="hover:text-gray-200 {{ request()->routeIs('dashboard') ? 'underline font-bold' : '' }}">
                            Dashboard
                        </a> -->
                        <a href="{{ route('calendar') }}" class="hover:text-gray-200 {{ request()->routeIs('calendar') ? 'underline font-bold' : '' }}">
                            My Calendar
                        </a>
                        <a href="{{ route('profile.edit') }}" class="hover:text-gray-200 {{ request()->routeIs('profile.edit') ? 'underline font-bold' : '' }}">
                           profile
                        </a>
                    </div>

                    <!-- User Info -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <span class="hidden sm:block">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="bg-white text-indigo-600 hover:bg-gray-100 px-3 py-1 rounded text-sm font-medium">
                                    Log Out
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-sm hover:text-gray-300">Login</a>
                            <a href="{{ route('register') }}" class="ml-2 text-sm hover:text-gray-300">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Optional Header (page specific) -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-grow">
       @yield('content') 

        </main>

        <!-- Footer (optional) -->
        <footer class="bg-gray-200 text-center text-sm text-gray-600 py-4">
            &copy; {{ date('Y') }} PlanWise
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
