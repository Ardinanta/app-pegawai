@extends('layouts.app')

@section('content')
    {{-- Header Halaman --}}
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Dashboard</h1>

    {{-- Awal dari Kartu Statistik --}}
    <div class="py-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
            <div class="flex-shrink-0 bg-blue-100 p-3 rounded-full">
                {{-- Ikon Users dari Heroicons --}}
                <svg class="w-8 h-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM8.25 10.125a2.625 2.625 0 115.25 0 2.625 2.625 0 01-5.25 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Total Karyawan</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalEmployees }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
            <div class="flex-shrink-0 bg-green-100 p-3 rounded-full">
                {{-- Ikon Check Badge dari Heroicons --}}
                <svg class="w-8 h-8 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Hadir Hari Ini</p>
                <p class="text-3xl font-bold text-gray-900">{{ $presentToday }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
            <div class="flex-shrink-0 bg-indigo-100 p-3 rounded-full">
                {{-- Ikon Building Office dari Heroicons --}}
                <svg class="w-8 h-8 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h6.75M9 10.5h6.75M9 14.25h6.75M9 18h6.75" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Total Departemen</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalDepartments }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
            <div class="flex-shrink-0 bg-yellow-100 p-3 rounded-full">
                {{-- Ikon Briefcase dari Heroicons --}}
                <svg class="w-8 h-8 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.07a2.25 2.25 0 01-2.25 2.25H5.625a2.25 2.25 0 01-2.25-2.25v-4.07m16.5 0v.217a2.25 2.25 0 01-2.25 2.25h-5.379a2.25 2.25 0 01-2.25-2.25V14.15M20.25 14.15M18 14.15v.217A2.25 2.25 0 0015.75 16.5h-5.379a2.25 2.25 0 00-2.25-2.25V14.15m6.621 0v1.125c0 .621-.504 1.125-1.125 1.125H9.375c-.621 0-1.125-.504-1.125-1.125V14.15m0 0a2.25 2.25 0 012.25-2.25h3.375a2.25 2.25 0 012.25 2.25m0 0c0 .621-.504 1.125-1.125 1.125h-3.375c-.621 0-1.125-.504-1.125-1.125m0 0c.621 0 1.125.504 1.125 1.125h.008c.621 0 1.125-.504 1.125-1.125h.008c.621 0 1.125.504 1.125 1.125h.008c.621 0 1.125-.504 1.125-1.125h.008a2.25 2.25 0 012.25 2.25v.217M8.25 14.15v.217a2.25 2.25 0 01-2.25 2.25H5.625a2.25 2.25 0 01-2.25-2.25V14.15m16.5 0a2.25 2.25 0 00-2.25-2.25h-5.379a2.25 2.25 0 00-2.25 2.25M3.75 11.85c0-1.12 1.56-2.06 3.486-2.06h9.028c1.926 0 3.486.94 3.486 2.06M3.75 11.85v2.25A2.25 2.25 0 006 16.5h.375m13.125 0h.375a2.25 2.25 0 002.25-2.25V11.85" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Total Jabatan</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalPositions }}</p>
            </div>
        </div>

    </div>
    {{-- Akhir dari Kartu Statistik --}}

    {{-- Di sini Anda bisa menambahkan komponen dashboard lainnya (Widget, Chart, dll) --}}

@endsection