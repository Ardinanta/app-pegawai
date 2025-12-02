@extends('layouts.app')

@section('content')
    {{-- STATISTICS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Total Karyawan --}}
        <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium uppercase">Total Karyawan</p>
                    <p class="text-4xl font-bold mt-2">{{ $totalEmployees }}</p>
                    <p class="text-blue-200 text-xs mt-2">Karyawan Aktif</p>
                </div>
                <div class="bg-blue-400 bg-opacity-30 rounded-full p-4">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Departemen --}}
        <div class="bg-gradient-to-br from-green-500 to-green-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium uppercase">Departemen</p>
                    <p class="text-4xl font-bold mt-2">{{ $totalDepartments }}</p>
                    <p class="text-green-200 text-xs mt-2">Total Departemen</p>
                </div>
                <div class="bg-green-400 bg-opacity-30 rounded-full p-4">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Jabatan --}}
        <div class="bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium uppercase">Jabatan</p>
                    <p class="text-4xl font-bold mt-2">{{ $totalPositions }}</p>
                    <p class="text-purple-200 text-xs mt-2">Posisi Tersedia</p>
                </div>
                <div class="bg-purple-400 bg-opacity-30 rounded-full p-4">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Hadir Hari Ini --}}
        <div class="bg-gradient-to-br from-orange-500 to-orange-700 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium uppercase">Hadir Hari Ini</p>
                    <p class="text-4xl font-bold mt-2">{{ $presentToday }}</p>
                    <p class="text-orange-200 text-xs mt-2">Dari {{ $totalEmployees }} Karyawan</p>
                </div>
                <div class="bg-orange-400 bg-opacity-30 rounded-full p-4">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- CHARTS ROW --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Pie Chart: Distribusi Karyawan per Departemen --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transition duration-300">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                </svg>
                Distribusi Karyawan per Departemen
            </h3>
            <div class="relative" style="height: 300px;">
                <canvas id="employeeChart"></canvas>
            </div>
        </div>

        {{-- Line Chart: Tren Kehadiran 30 Hari Terakhir --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transition duration-300">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                </svg>
                Tren Kehadiran (30 Hari Terakhir)
            </h3>
            <div class="relative" style="height: 300px;">
                <canvas id="attendanceTrendChart"></canvas>
            </div>
        </div>
    </div>

    {{-- BAR CHART & WIDGETS ROW --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Bar Chart: Gaji per Departemen Bulan Lalu --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transition duration-300">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Total Gaji per Departemen (Bulan Lalu)
            </h3>
            <div class="relative" style="height: 300px;">
                <canvas id="salaryChart"></canvas>
            </div>
        </div>

        {{-- Widget: Ringkasan Absensi Hari Ini --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transition duration-300">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Ringkasan Hari Ini
            </h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="bg-green-500 rounded-full p-2">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span class="ml-3 font-semibold text-gray-700">Hadir</span>
                    </div>
                    <span class="text-2xl font-bold text-green-600">{{ $attendanceSummary['Hadir'] ?? 0 }}</span>
                </div>

                <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-xl border-l-4 border-yellow-500">
                    <div class="flex items-center">
                        <div class="bg-yellow-500 rounded-full p-2">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span class="ml-3 font-semibold text-gray-700">Sakit</span>
                    </div>
                    <span class="text-2xl font-bold text-yellow-600">{{ $attendanceSummary['sakit'] ?? 0 }}</span>
                </div>

                <div class="flex items-center justify-between p-4 bg-blue-50 rounded-xl border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="bg-blue-500 rounded-full p-2">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span class="ml-3 font-semibold text-gray-700">Izin</span>
                    </div>
                    <span class="text-2xl font-bold text-blue-600">{{ $attendanceSummary['izin'] ?? 0 }}</span>
                </div>

                <div class="flex items-center justify-between p-4 bg-red-50 rounded-xl border-l-4 border-red-500">
                    <div class="flex items-center">
                        <div class="bg-red-500 rounded-full p-2">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span class="ml-3 font-semibold text-gray-700">Alpa</span>
                    </div>
                    <span class="text-2xl font-bold text-red-600">{{ $attendanceSummary['alpa'] ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart.js Script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Pie Chart: Distribusi Karyawan
        const employeeCtx = document.getElementById('employeeChart').getContext('2d');
        new Chart(employeeCtx, {
            type: 'pie',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    data: @json($chartData),
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(251, 146, 60, 0.8)',
                        'rgba(168, 85, 247, 0.8)',
                        'rgba(236, 72, 153, 0.8)',
                        'rgba(14, 165, 233, 0.8)',
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });

        // Line Chart: Tren Kehadiran
        const trendCtx = document.getElementById('attendanceTrendChart').getContext('2d');
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: @json($trendLabels),
                datasets: [{
                    label: 'Kehadiran',
                    data: @json($trendData),
                    borderColor: 'rgba(16, 185, 129, 1)',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: 'rgba(16, 185, 129, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Bar Chart: Gaji per Departemen
        const salaryCtx = document.getElementById('salaryChart').getContext('2d');
        new Chart(salaryCtx, {
            type: 'bar',
            data: {
                labels: @json($salaryLabels),
                datasets: [{
                    label: 'Total Gaji (Rp)',
                    data: @json($salaryData),
                    backgroundColor: 'rgba(168, 85, 247, 0.8)',
                    borderColor: 'rgba(168, 85, 247, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
