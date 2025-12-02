<nav x-data="{ open: false }" class="bg-gradient-to-r from-blue-600 to-blue-700 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center sm:-ml-8">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <div class="bg-white p-2 rounded-lg shadow-md">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white">App<span class="text-cyan-300">Pegawai</span></span>
                </a>
            </div>

            <!-- Navigation Links - Center -->
            <div class="hidden sm:flex sm:items-center flex-1 justify-center">
                <div class="flex space-x-1">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-800 hover:text-white' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('employees.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('employees.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-800 hover:text-white' }}">
                        Karyawan
                    </a>
                    <a href="{{ route('departments.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('departments.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-800 hover:text-white' }}">
                        Departemen
                    </a>
                    <a href="{{ route('positions.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('positions.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-800 hover:text-white' }}">
                        Jabatan
                    </a>
                    <a href="{{ route('attendances.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('attendances.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-800 hover:text-white' }}">
                        Absensi
                    </a>
                    <a href="{{ route('attendance-monitoring.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('attendance-monitoring.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-800 hover:text-white' }}">
                        Monitoring
                    </a>
                    <a href="{{ route('salaries.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('salaries.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-800 hover:text-white' }}">
                        Gaji
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-blue-500 text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-blue-100 hover:text-white hover:bg-blue-800 focus:outline-none focus:bg-blue-800 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-blue-700">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors {{ request()->routeIs('dashboard') ? 'border-cyan-300 text-cyan-300 bg-blue-800' : 'border-transparent text-blue-100 hover:bg-blue-800 hover:border-cyan-300 hover:text-white' }}">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </div>
            </a>

            <!-- Karyawan -->
            <a href="{{ route('employees.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors {{ request()->routeIs('employees.*') ? 'border-cyan-300 text-cyan-300 bg-blue-800' : 'border-transparent text-blue-100 hover:bg-blue-800 hover:border-cyan-300 hover:text-white' }}">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Karyawan</span>
                </div>
            </a>

            <!-- Departemen -->
            <a href="{{ route('departments.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors {{ request()->routeIs('departments.*') ? 'border-cyan-300 text-cyan-300 bg-blue-800' : 'border-transparent text-blue-100 hover:bg-blue-800 hover:border-cyan-300 hover:text-white' }}">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <span>Departemen</span>
                </div>
            </a>

            <!-- Jabatan -->
            <a href="{{ route('positions.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors {{ request()->routeIs('positions.*') ? 'border-cyan-300 text-cyan-300 bg-blue-800' : 'border-transparent text-blue-100 hover:bg-blue-800 hover:border-cyan-300 hover:text-white' }}">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>Jabatan</span>
                </div>
            </a>

            <!-- Absensi -->
            <a href="{{ route('attendances.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors {{ request()->routeIs('attendances.*') ? 'border-cyan-300 text-cyan-300 bg-blue-800' : 'border-transparent text-blue-100 hover:bg-blue-800 hover:border-cyan-300 hover:text-white' }}">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    <span>Absensi</span>
                </div>
            </a>

            <!-- Monitoring -->
            <a href="{{ route('attendance-monitoring.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors {{ request()->routeIs('attendance-monitoring.*') ? 'border-cyan-300 text-cyan-300 bg-blue-800' : 'border-transparent text-blue-100 hover:bg-blue-800 hover:border-cyan-300 hover:text-white' }}">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span>Monitoring Absensi</span>
                </div>
            </a>

            <!-- Gaji -->
            <a href="{{ route('salaries.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors {{ request()->routeIs('salaries.*') ? 'border-cyan-300 text-cyan-300 bg-blue-800' : 'border-transparent text-blue-100 hover:bg-blue-800 hover:border-cyan-300 hover:text-white' }}">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Gaji</span>
                </div>
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-blue-600">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-blue-200">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-blue-100 hover:text-white hover:bg-blue-800 hover:border-cyan-300 transition-colors">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Profile</span>
                    </div>
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="w-full text-left pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-blue-100 hover:text-white hover:bg-blue-800 hover:border-cyan-300 transition-colors">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Log Out</span>
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
