<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AppPegawai') }} - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex flex-col">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Page Content -->
    <main class="px-4 sm:px-6 lg:px-8 flex-grow">
        <div class="max-w-7xl mx-auto py-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-800 text-white py-6 mt-auto">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="mb-4 md:mb-0">
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="bg-blue-500 p-2 rounded-lg shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold">App<span class="text-cyan-300">Pegawai</span></span>
                    </div>
                    <p class="text-gray-300 text-xs ml-0 font-medium">© 2025 <span class="text-cyan-300 font-semibold">AppPegawai</span>. All rights reserved.</p>
                </div>
                <div class="flex flex-col md:flex-row gap-4 md:gap-6 text-sm">
                    <a href="#" class="text-gray-300 hover:text-cyan-300 transition duration-150 font-medium">Privacy Policy</a>
                    <a href="#" class="text-gray-300 hover:text-cyan-300 transition duration-150 font-medium">Terms of Service</a>
                    <a href="#" class="text-gray-300 hover:text-cyan-300 transition duration-150 font-medium">Contact</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
