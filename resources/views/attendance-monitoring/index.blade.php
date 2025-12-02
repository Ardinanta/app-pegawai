@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        {{-- Header Section --}}
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg p-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-white">Monitoring Absensi</h1>
                    <p class="text-sm text-blue-100 mt-1 font-medium">{{ $date->translatedFormat('l, d F Y') }}</p>
                </div>
                <form method="GET" action="{{ route('attendance-monitoring.index') }}" class="flex items-center gap-2">
                    <input type="date" name="date" value="{{ $selectedDate }}"
                        class="px-4 py-2 bg-white border-2 border-blue-200 rounded-lg focus:ring-2 focus:ring-white focus:border-white text-sm font-medium shadow-sm"
                        onchange="this.form.submit()">
                    <button type="submit"
                        class="px-4 py-2 bg-white text-blue-700 rounded-lg hover:bg-blue-50 transition-colors shadow-sm font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        {{-- Statistics Cards --}}
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-5 shadow-md">
                <div class="flex items-center gap-3">
                    <div class="bg-white/20 rounded-lg p-2.5 backdrop-blur-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-purple-100 font-semibold">Total</p>
                        <p class="text-2xl font-bold text-white">{{ $overallStats['total_employees'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-5 shadow-md">
                <div class="flex items-center gap-3">
                    <div class="bg-white/20 rounded-lg p-2.5 backdrop-blur-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-green-100 font-semibold">Hadir</p>
                        <p class="text-2xl font-bold text-white">{{ $overallStats['total_present'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl p-5 shadow-md">
                <div class="flex items-center gap-3">
                    <div class="bg-white/20 rounded-lg p-2.5 backdrop-blur-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-yellow-100 font-semibold">Sakit</p>
                        <p class="text-2xl font-bold text-white">{{ $overallStats['total_sick'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-5 shadow-md">
                <div class="flex items-center gap-3">
                    <div class="bg-white/20 rounded-lg p-2.5 backdrop-blur-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-blue-100 font-semibold">Izin</p>
                        <p class="text-2xl font-bold text-white">{{ $overallStats['total_permission'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl p-5 shadow-md">
                <div class="flex items-center gap-3">
                    <div class="bg-white/20 rounded-lg p-2.5 backdrop-blur-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-red-100 font-semibold">Alpa</p>
                        <p class="text-2xl font-bold text-white">{{ $overallStats['total_absent'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Departments Section --}}
        <div class="space-y-4">
            @forelse ($departmentsWithAttendance as $department)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    {{-- Department Header --}}
                    <div class="bg-gradient-to-r from-slate-50 to-slate-100 px-6 py-4 border-b border-slate-200">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                            <div>
                                <h2 class="text-lg font-bold text-slate-800">{{ $department['nama_departemen'] }}</h2>
                                <div class="flex flex-wrap gap-2 mt-2 text-xs">
                                    <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded">
                                        Total: {{ $department['statistics']['total'] }}
                                    </span>
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded">
                                        Hadir: {{ $department['statistics']['present'] }}
                                    </span>
                                    @if ($department['statistics']['sick'] > 0)
                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">
                                            Sakit: {{ $department['statistics']['sick'] }}
                                        </span>
                                    @endif
                                    @if ($department['statistics']['permission'] > 0)
                                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded">
                                            Izin: {{ $department['statistics']['permission'] }}
                                        </span>
                                    @endif
                                    @if ($department['statistics']['absent'] > 0)
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded">
                                            Alpa: {{ $department['statistics']['absent'] }}
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
                                <p class="text-2xl font-bold text-gray-800">{{ $attendanceRate }}%</p>
                                <p class="text-xs text-gray-600 font-medium">Kehadiran</p>
                            </div>
                        </div>
                    </div>

                    {{-- Employees Table --}}
                    <div class="overflow-x-auto">
                        @if (count($department['employees']) > 0)
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jabatan</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Waktu</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($department['employees'] as $employee)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">{{ $employee['nama_lengkap'] }}</div>
                                                        <div class="text-xs text-gray-600 font-medium">{{ $employee['email'] }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $employee['position'] }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                @if ($employee['attendance'])
                                                    @php
                                                        $status = strtolower($employee['attendance']['status']);
                                                        $statusConfig = [
                                                            'hadir' => ['label' => 'Hadir', 'class' => 'bg-green-100 text-green-800'],
                                                            'sakit' => ['label' => 'Sakit', 'class' => 'bg-yellow-100 text-yellow-800'],
                                                            'izin' => ['label' => 'Izin', 'class' => 'bg-blue-100 text-blue-800'],
                                                            'alpa' => ['label' => 'Alpa', 'class' => 'bg-red-100 text-red-800'],
                                                        ];
                                                        $config = $statusConfig[$status] ?? ['label' => ucfirst($status), 'class' => 'bg-gray-100 text-gray-800'];
                                                    @endphp
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $config['class'] }}">
                                                        {{ $config['label'] }}
                                                    </span>
                                                @else
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-600">
                                                        Belum Absen
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-700 font-medium">
                                                @if ($employee['attendance'])
                                                    <div class="flex flex-col gap-1">
                                                        @if ($employee['attendance']['waktu_masuk'])
                                                            <span class="text-xs">
                                                                <span class="text-gray-600 font-medium">In:</span> {{ \Carbon\Carbon::parse($employee['attendance']['waktu_masuk'])->format('H:i') }}
                                                            </span>
                                                        @endif
                                                        @if ($employee['attendance']['waktu_keluar'])
                                                            <span class="text-xs">
                                                                <span class="text-gray-600 font-medium">Out:</span> {{ \Carbon\Carbon::parse($employee['attendance']['waktu_keluar'])->format('H:i') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span class="text-gray-600 text-xs font-medium">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-600 font-medium">Tidak ada karyawan</p>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada departemen</h3>
                    <p class="mt-1 text-sm text-gray-600 font-medium">Silakan tambahkan departemen terlebih dahulu.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
