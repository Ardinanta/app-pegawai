<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Karyawan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">

    {{-- AWAL DARI KODE NAVBAR --}}
    <nav class="bg-gray-800 shadow-lg px-6">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="text-white text-xl font-bold">StafHub</a>
                </div>

                <div class="hidden md:flex md:items-center md:space-x-8"> 
                    <a href="{{ route('employees.index') }}"
                        class="relative {{ request()->routeIs('employees.*') ? 'text-cyan-400' : 'text-gray-300' }} hover:text-cyan-400 transition-colors duration-300 py-2 group">
                        <span>Karyawan</span>

                        <span
                            class="absolute bottom-0 left-0 w-full h-[3px] bg-cyan-400 
                                    transform {{ request()->routeIs('employees.*') ? 'scale-x-100' : 'scale-x-0' }} 
                                    group-hover:scale-x-100 transition-transform duration-300 ease-out origin-left">
                        </span>
                    </a>

                    <a href="{{ route('departments.index') }}"
                        class="relative {{ request()->routeIs('departments.*') ? 'text-cyan-400' : 'text-gray-300' }} hover:text-cyan-400 transition-colors duration-300 py-2 group">
                        <span>Departemen</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-[3px] bg-cyan-400 
                                    transform {{ request()->routeIs('departments.*') ? 'scale-x-100' : 'scale-x-0' }} 
                                    group-hover:scale-x-100 transition-transform duration-300 ease-out origin-left">
                        </span>
                    </a>

                    <a href="{{ route('positions.index') }}"
                        class="relative {{ request()->routeIs('positions.*') ? 'text-cyan-400' : 'text-gray-300' }} hover:text-cyan-400 transition-colors duration-300 py-2 group">
                        <span>Jabatan</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-[3px] bg-cyan-400 
                                    transform {{ request()->routeIs('positions.*') ? 'scale-x-100' : 'scale-x-0' }} 
                                    group-hover:scale-x-100 transition-transform duration-300 ease-out origin-left">
                        </span>
                    </a>

                    <a href="{{ route('salaries.index') }}"
                        class="relative {{ request()->routeIs('salaries.*') ? 'text-cyan-400' : 'text-gray-300' }} hover:text-cyan-400 transition-colors duration-300 py-2 group">
                        <span>Gaji</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-[3px] bg-cyan-400 
                                    transform {{ request()->routeIs('salaries.*') ? 'scale-x-100' : 'scale-x-0' }} 
                                    group-hover:scale-x-100 transition-transform duration-300 ease-out origin-left">
                        </span>
                    </a>

                    <a href="{{ route('attendances.index') }}"
                        class="relative {{ request()->routeIs('attendances.*') ? 'text-cyan-400' : 'text-gray-300' }} hover:text-cyan-400 transition-colors duration-300 py-2 group">
                        <span>Attendance</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-[3px] bg-cyan-400 
                                    transform {{ request()->routeIs('attendances.*') ? 'scale-x-100' : 'scale-x-0' }} 
                                    group-hover:scale-x-100 transition-transform duration-300 ease-out origin-left">
                        </span>
                    </a>

                </div>

                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button"
                        class="text-gray-300 hover:text-white focus:outline-none focus:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('employees.index') }}"
                    class="{{ request()->routeIs('employees.*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">Karyawan</a>
                <a href="{{ route('departments.index') }}"
                    class="{{ request()->routeIs('departments.*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">Departemen</a>
                <a href="{{ route('positions.index') }}"
                    class="{{ request()->routeIs('positions.*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">Jabatan</a>
                <a href="{{ route('salaries.index') }}"
                    class="{{ request()->routeIs('salaries.*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">Gaji</a>
                <a href="{{ route('attendances.index') }}"
                    class="{{ request()->routeIs('attendances.*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">Attendance</a>
            </div>
        </div>
    </nav>
    {{-- AKHIR DARI KODE NAVBAR --}}

    <main class="container mx-auto mt-6 px-4">
        @yield('content')
    </main>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

</body>

</html>
