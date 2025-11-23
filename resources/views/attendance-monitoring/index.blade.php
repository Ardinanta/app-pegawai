@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        {{-- Header Section --}}
        <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-6 border border-white/20">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Monitoring Absensi Karyawan</h1>
                </div>
                <div class="flex items-center gap-3">
                    <form method="GET" action="{{ route('attendance-monitoring.index') }}" class="flex items-center gap-2">
                        <input type="date" name="date" value="{{ $selectedDate }}"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                            onchange="this.form.submit()">
                        <button type="submit"
                            class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-lg hover:from-cyan-600 hover:to-blue-600 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Overall Statistics --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <div
                class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium mb-1">Total Karyawan</p>
                        <p class="text-3xl font-bold">{{ $overallStats['total_employees'] }}</p>
                    </div>
                    <div class="bg-white/20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium mb-1">Hadir</p>
                        <p class="text-3xl font-bold">{{ $overallStats['total_present'] }}</p>
                    </div>
                    <div class="bg-white/20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl p-6 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-medium mb-1">Tidak Hadir</p>
                        <p class="text-3xl font-bold">{{ $overallStats['total_absent'] }}</p>
                    </div>
                    <div class="bg-white/20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl p-6 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100 text-sm font-medium mb-1">Sakit</p>
                        <p class="text-3xl font-bold">{{ $overallStats['total_sick'] }}</p>
                    </div>
                    <div class="bg-white/20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl p-6 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-indigo-100 text-sm font-medium mb-1">Izin</p>
                        <p class="text-3xl font-bold">{{ $overallStats['total_permission'] }}</p>
                    </div>
                    <div class="bg-white/20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Date Display --}}
        <div class="bg-white/80 backdrop-blur-lg rounded-xl p-4 border border-white/20 shadow-lg">
            <p class="text-center text-gray-700 font-semibold">
                <svg class="w-5 h-5 inline-block mr-2 text-cyan-500" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Data Absensi untuk: <span class="text-cyan-600">{{ $date->translatedFormat('l, d F Y') }}</span>
            </p>
        </div>

        {{-- Departments Section --}}
        <div class="space-y-6">
            @forelse ($departmentsWithAttendance as $department)
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                    {{-- Department Header --}}
                    <div class="bg-gradient-to-r from-cyan-500 to-blue-500 p-6 text-white">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div>
                                <h2 class="text-2xl font-bold mb-2">{{ $department['nama_departemen'] }}</h2>
                                <div class="flex flex-wrap gap-3 text-sm">
                                    <span class="bg-white/20 px-3 py-1 rounded-full">
                                        Total: <strong>{{ $department['statistics']['total'] }}</strong>
                                    </span>
                                    <span class="bg-green-500/30 px-3 py-1 rounded-full">
                                        Hadir: <strong>{{ $department['statistics']['present'] }}</strong>
                                    </span>
                                    <span class="bg-red-500/30 px-3 py-1 rounded-full">
                                        Tidak Hadir: <strong>{{ $department['statistics']['absent'] }}</strong>
                                    </span>
                                    @if ($department['statistics']['sick'] > 0)
                                        <span class="bg-yellow-500/30 px-3 py-1 rounded-full">
                                            Sakit: <strong>{{ $department['statistics']['sick'] }}</strong>
                                        </span>
                                    @endif
                                    @if ($department['statistics']['permission'] > 0)
                                        <span class="bg-indigo-500/30 px-3 py-1 rounded-full">
                                            Izin: <strong>{{ $department['statistics']['permission'] }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right">
                                @php
                                    $attendanceRate =
                                        $department['statistics']['total'] > 0
                                            ? round(
                                                ($department['statistics']['present'] /
                                                    $department['statistics']['total']) *
                                                    100,
                                                1,
                                            )
                                            : 0;
                                @endphp
                                <p class="text-3xl font-bold">{{ $attendanceRate }}%</p>
                                <p class="text-sm text-white/80">Tingkat Kehadiran</p>
                            </div>
                        </div>
                    </div>

                    {{-- Employees List --}}
                    <div class="p-6">
                        @if (count($department['employees']) > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach ($department['employees'] as $employee)
                                    <div
                                        class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border-2 transition-all duration-300 hover:shadow-lg transform hover:scale-105
                                    {{ $employee['is_present'] ? 'border-green-300 bg-green-50/50' : ($employee['is_absent'] ? 'border-red-300 bg-red-50/50' : 'border-yellow-300 bg-yellow-50/50') }}">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex-1">
                                                <h3 class="font-bold text-gray-800 text-lg mb-1">
                                                    {{ $employee['nama_lengkap'] }}</h3>
                                                <p class="text-sm text-gray-600 mb-1">{{ $employee['email'] }}</p>
                                                <p class="text-xs text-gray-500">{{ $employee['position'] }}</p>
                                            </div>
                                            <div>
                                                @if ($employee['is_present'])
                                                    <div class="bg-green-500 text-white rounded-full p-2">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    </div>
                                                @elseif($employee['attendance'] && strtolower($employee['attendance']['status']) === 'sakit')
                                                    <div class="bg-yellow-500 text-white rounded-full p-2">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </div>
                                                @elseif($employee['attendance'] && strtolower($employee['attendance']['status']) === 'izin')
                                                    <div class="bg-indigo-500 text-white rounded-full p-2">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                    </div>
                                                @else
                                                    <div class="bg-red-500 text-white rounded-full p-2">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mt-3 pt-3 border-t border-gray-200">
                                            @if ($employee['attendance'])
                                                @php
                                                    $status = strtolower($employee['attendance']['status']);
                                                    $statusColors = [
                                                        'hadir' => 'bg-green-100 text-green-800 border-green-300',
                                                        'sakit' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                                                        'izin' => 'bg-indigo-100 text-indigo-800 border-indigo-300',
                                                        'alpha' => 'bg-red-100 text-red-800 border-red-300',
                                                    ];
                                                    $statusLabels = [
                                                        'hadir' => 'Hadir',
                                                        'sakit' => 'Sakit',
                                                        'izin' => 'Izin',
                                                        'alpha' => 'Alpha',
                                                    ];
                                                @endphp
                                                <div class="flex items-center justify-between mb-2">
                                                    <span
                                                        class="px-3 py-1 rounded-full text-xs font-semibold border {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                                        {{ $statusLabels[$status] ?? ucfirst($status) }}
                                                    </span>
                                                </div>
                                                @if ($employee['attendance']['waktu_masuk'])
                                                    <div class="flex items-center text-xs text-gray-600 mb-1">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        Masuk:
                                                        {{ \Carbon\Carbon::parse($employee['attendance']['waktu_masuk'])->format('H:i') }}
                                                    </div>
                                                @endif
                                                @if ($employee['attendance']['waktu_keluar'])
                                                    <div class="flex items-center text-xs text-gray-600">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        Keluar:
                                                        {{ \Carbon\Carbon::parse($employee['attendance']['waktu_keluar'])->format('H:i') }}
                                                    </div>
                                                @endif
                                            @else
                                                <span
                                                    class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800 border border-gray-300">
                                                    Belum ada data
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <p class="text-lg">Tidak ada karyawan aktif di departemen ini</p>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-12 text-center border border-white/20">
                    <svg class="w-24 h-24 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-700 mb-2">Belum Ada Departemen</h3>
                    <p class="text-gray-500">Silakan tambahkan departemen terlebih dahulu untuk memulai monitoring absensi.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
