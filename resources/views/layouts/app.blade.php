<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Karyawan - AppPegawai</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Animated gradient background */
        @keyframes gradient-shift {
            0%, 100% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
        }

        .animated-gradient {
            background: linear-gradient(-45deg, #f0f9ff, #e0f2fe, #dbeafe, #e0e7ff, #f3e8ff);
            background-size: 400% 400%;
            animation: gradient-shift 15s ease infinite;
        }

        /* Navbar blur effect with enhanced glassmorphism */
        .navbar-blur {
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(30, 41, 59, 0.85) 100%);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.15);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Navbar scroll effect */
        .navbar-scrolled {
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            box-shadow: 0 12px 40px 0 rgba(0, 0, 0, 0.2);
        }

        /* Enhanced nav link hover effect */
        .nav-link {
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        /* Active nav link glow */
        .nav-link-active {
            background: linear-gradient(135deg, rgba(6, 182, 212, 0.2) 0%, rgba(59, 130, 246, 0.15) 100%);
            box-shadow: 0 4px 20px rgba(6, 182, 212, 0.3);
            border: 1px solid rgba(6, 182, 212, 0.3);
        }

        /* Logo animation */
        @keyframes logo-pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 20px rgba(6, 182, 212, 0.4);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 30px rgba(6, 182, 212, 0.6);
            }
        }

        .logo-container {
            animation: logo-pulse 3s ease-in-out infinite;
        }

        /* Custom scrollbar with modern design */
        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            background: linear-gradient(180deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #06b6d4 0%, #3b82f6 100%);
            border-radius: 10px;
            border: 2px solid #f8fafc;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #0891b2 0%, #2563eb 100%);
        }

        /* Smooth fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        /* Mobile menu slide animation */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .mobile-menu-open {
            animation: slideDown 0.3s ease-out;
        }

        /* Enhanced footer gradient */
        .footer-gradient {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(30, 41, 59, 0.95) 100%);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        /* Glow effect for links */
        .glow-on-hover {
            transition: all 0.3s ease;
        }

        .glow-on-hover:hover {
            text-shadow: 0 0 10px rgba(6, 182, 212, 0.5);
        }
    </style>
</head>

<body class="animated-gradient min-h-screen relative overflow-x-hidden flex flex-col">

    {{-- NAVBAR MODERN --}}
    <nav id="navbar" class="navbar-blur sticky top-0 z-50 transition-all duration-300">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center h-20">
                {{-- Logo --}}
                <div class="flex items-center space-x-3">
                    <div class="logo-container w-12 h-12 bg-gradient-to-br from-cyan-400 via-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-xl transform transition-transform hover:scale-110">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <a href="{{ url('/') }}" class="text-white text-2xl font-bold tracking-tight glow-on-hover">
                        App<span class="text-cyan-400 bg-gradient-to-r from-cyan-400 to-blue-400 bg-clip-text text-transparent">Pegawai</span>
                    </a>
                </div>

                {{-- Desktop Menu --}}
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="{{ url('/') }}"
                        class="nav-link px-3 py-2 rounded-lg {{ request()->is('/') ? 'nav-link-active text-cyan-300' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300 text-sm font-medium">
                        <div class="flex items-center space-x-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span>Dashboard</span>
                        </div>
                    </a>

                    <a href="{{ route('employees.index') }}"
                        class="nav-link px-3 py-2 rounded-lg {{ request()->routeIs('employees.*') ? 'nav-link-active text-cyan-300' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300 text-sm font-medium">
                        <div class="flex items-center space-x-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span>Karyawan</span>
                        </div>
                    </a>

                    <a href="{{ route('departments.index') }}"
                        class="nav-link px-3 py-2 rounded-lg {{ request()->routeIs('departments.*') ? 'nav-link-active text-cyan-300' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300 text-sm font-medium">
                        <div class="flex items-center space-x-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span>Departemen</span>
                        </div>
                    </a>

                    <a href="{{ route('positions.index') }}"
                        class="nav-link px-3 py-2 rounded-lg {{ request()->routeIs('positions.*') ? 'nav-link-active text-cyan-300' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300 text-sm font-medium">
                        <div class="flex items-center space-x-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>Jabatan</span>
                        </div>
                    </a>

                    <a href="{{ route('salaries.index') }}"
                        class="nav-link px-3 py-2 rounded-lg {{ request()->routeIs('salaries.*') ? 'nav-link-active text-cyan-300' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300 text-sm font-medium">
                        <div class="flex items-center space-x-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Gaji</span>
                        </div>
                    </a>

                    <a href="{{ route('attendances.index') }}"
                        class="nav-link px-3 py-2 rounded-lg {{ request()->routeIs('attendances.*') ? 'nav-link-active text-cyan-300' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300 text-sm font-medium">
                        <div class="flex items-center space-x-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                            <span>Absensi</span>
                        </div>
                    </a>

                    <a href="{{ route('attendance-monitoring.index') }}"
                        class="nav-link px-3 py-2 rounded-lg {{ request()->routeIs('attendance-monitoring.*') ? 'nav-link-active text-cyan-300' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300 text-sm font-medium">
                        <div class="flex items-center space-x-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <span>Monitoring</span>
                        </div>
                    </a>

                    {{-- User Menu --}}
                    @auth
                        <div class="flex items-center space-x-1.5 ml-1">
                            <div class="flex items-center space-x-1.5 px-3 py-2 rounded-lg bg-white/10 text-gray-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                            </div>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="px-3 py-2 rounded-lg bg-red-500/20 text-red-300 hover:bg-red-500/30 transition-all duration-300 text-sm font-medium">
                                    <div class="flex items-center space-x-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        <span>Logout</span>
                                    </div>
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center space-x-1.5 ml-1">
                            <a href="{{ route('login') }}"
                                class="px-3 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-300 text-sm font-medium">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}"
                                class="px-3 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-500 text-white hover:from-cyan-600 hover:to-blue-600 transition-all duration-300 text-sm font-medium">
                                Daftar
                            </a>
                        </div>
                    @endauth
                </div>

                {{-- Mobile Menu Button --}}
                <button id="mobile-menu-button" class="lg:hidden text-gray-300 hover:text-white focus:outline-none p-3 rounded-xl hover:bg-white/10 transition-all duration-300 transform hover:scale-110">
                    <svg id="menu-icon" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="close-icon" class="w-6 h-6 transition-transform duration-300 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden lg:hidden border-t border-white/10 backdrop-blur-md bg-white/5">
            <div class="px-4 pt-3 pb-5 space-y-2">
                <a href="{{ url('/') }}"
                    class="flex items-center space-x-3 px-5 py-3.5 rounded-xl {{ request()->is('/') ? 'nav-link-active text-cyan-300' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300 transform hover:scale-[1.02]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('employees.index') }}"
                    class="flex items-center space-x-3 px-5 py-3.5 rounded-xl {{ request()->routeIs('employees.*') ? 'nav-link-active text-cyan-300' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300 transform hover:scale-[1.02]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="font-medium">Karyawan</span>
                </a>

                <a href="{{ route('departments.index') }}"
                    class="flex items-center space-x-3 px-5 py-3.5 rounded-xl {{ request()->routeIs('departments.*') ? 'nav-link-active text-cyan-300' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300 transform hover:scale-[1.02]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <span class="font-medium">Departemen</span>
                </a>

                <a href="{{ route('positions.index') }}"
                    class="flex items-center space-x-3 px-5 py-3.5 rounded-xl {{ request()->routeIs('positions.*') ? 'nav-link-active text-cyan-300' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300 transform hover:scale-[1.02]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="font-medium">Jabatan</span>
                </a>

                <a href="{{ route('salaries.index') }}"
                    class="flex items-center space-x-3 px-5 py-3.5 rounded-xl {{ request()->routeIs('salaries.*') ? 'nav-link-active text-cyan-300' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300 transform hover:scale-[1.02]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">Gaji</span>
                </a>

                <a href="{{ route('attendances.index') }}"
                    class="flex items-center space-x-3 px-5 py-3.5 rounded-xl {{ request()->routeIs('attendances.*') ? 'nav-link-active text-cyan-300' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300 transform hover:scale-[1.02]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    <span class="font-medium">Absensi</span>
                </a>

                <a href="{{ route('attendance-monitoring.index') }}"
                    class="flex items-center space-x-3 px-5 py-3.5 rounded-xl {{ request()->routeIs('attendance-monitoring.*') ? 'nav-link-active text-cyan-300' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300 transform hover:scale-[1.02]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="font-medium">Monitoring</span>
                </a>

                {{-- Mobile User Menu --}}
                @auth
                    <div class="border-t border-white/10 pt-3 mt-3">
                        <div class="flex items-center space-x-3 px-5 py-3 rounded-xl bg-white/10 text-gray-300 mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="font-medium">{{ Auth::user()->name }}</span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" 
                                    class="w-full flex items-center space-x-3 px-5 py-3.5 rounded-xl bg-red-500/20 text-red-300 hover:bg-red-500/30 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span class="font-medium">Logout</span>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="border-t border-white/10 pt-3 mt-3 space-y-2">
                        <a href="{{ route('login') }}"
                            class="flex items-center space-x-3 px-5 py-3.5 rounded-xl text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            <span class="font-medium">Masuk</span>
                        </a>
                        <a href="{{ route('register') }}"
                            class="flex items-center space-x-3 px-5 py-3.5 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 text-white hover:from-cyan-600 hover:to-blue-600 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            <span class="font-medium">Daftar</span>
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="container mx-auto mt-8 px-4 pb-12 fade-in flex-grow">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="footer-gradient text-gray-300 mt-auto border-t border-white/10">
        <div class="container mx-auto px-6 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-6 md:mb-0">
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white">App<span class="text-cyan-400">Pegawai</span></span>
                    </div>
                    <p class="text-sm text-gray-400">&copy; 2024 <span class="font-semibold text-cyan-400">AppPegawai</span>. All rights reserved.</p>
                </div>
                <div class="flex flex-wrap justify-center md:justify-end gap-6">
                    <a href="#" class="text-sm text-gray-400 hover:text-cyan-400 transition-all duration-300 transform hover:scale-105 glow-on-hover">Privacy Policy</a>
                    <a href="#" class="text-sm text-gray-400 hover:text-cyan-400 transition-all duration-300 transform hover:scale-105 glow-on-hover">Terms of Service</a>
                    <a href="#" class="text-sm text-gray-400 hover:text-cyan-400 transition-all duration-300 transform hover:scale-105 glow-on-hover">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        let lastScroll = 0;
        const navbar = document.getElementById('navbar');
        
        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
            
            lastScroll = currentScroll;
        });

        // Mobile menu toggle with icon animation
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');
        
        mobileMenuButton.addEventListener('click', function() {
            const isHidden = mobileMenu.classList.contains('hidden');
            
            if (isHidden) {
                mobileMenu.classList.remove('hidden');
                mobileMenu.classList.add('mobile-menu-open');
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('mobile-menu-open');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('mobile-menu-open');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });

        // Close mobile menu when clicking on a link
        const mobileMenuLinks = mobileMenu.querySelectorAll('a');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('mobile-menu-open');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href.length > 1) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    </script>

</body>

</html>