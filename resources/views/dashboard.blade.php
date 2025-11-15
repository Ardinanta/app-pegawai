@extends('layouts.app')

@section('content')
    {{-- <h2 class="text-2xl font-bold text-gray-800 mb-6 px-6">Dashboard</h2> --}}

    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">

        <div class="bg-white p-6 rounded-lg shadow-xl">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Karyawan Tidak Hadir Hari Ini</h2>

            <div class="space-y-4">
                @forelse($absentToday as $attendance)
                    <div class="flex items-center space-x-4 p-2 rounded-lg hover:bg-gray-50">
                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center">
                            <span class="text-xl font-bold text-gray-600">
                                {{ strtoupper(substr($attendance->employee->nama_lengkap, 0, 1)) }}
                            </span>
                        </div>
                        <div class="flex-1">
                            <p class="text-base font-bold text-gray-900">{{ $attendance->employee->nama_lengkap }}</p>
                            <p class="text-sm text-gray-600 font-medium">
                                {{ $attendance->employee->department->nama_departemen }}</p>
                            <p class="text-sm text-gray-500">{{ $attendance->employee->position->nama_jabatan }}</p>
                        </div>
                        <div class="text-right">
                            @php
                                $status = $attendance->status_absensi;
                                $color =
                                    $status == 'sakit' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800';
                            @endphp
                            <span class="px-4 py-2 font-bold leading-tight rounded-lg text-sm {{ $color }}">
                                {{ ucfirst($status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">Semua karyawan hadir hari ini. 👍</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-xl">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Ringkasan Kehadiran Hari Ini</h2>

            @php
                // Ambil data dari controller, beri nilai default 0 jika tidak ada
                $hadir = $attendanceSummary['hadir'] ?? 0;
                $sakit = $attendanceSummary['sakit'] ?? 0;
                $izin = $attendanceSummary['izin'] ?? 0;
                $alpha = $attendanceSummary['alpha'] ?? 0;
                $totalKaryawan = $totalEmployees; // Ambil dari stat card
                $belumAbsen = $totalKaryawan - ($hadir + $sakit + $izin + $alpha);
            @endphp

            <div class="space-y-5 mt-6">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-medium text-gray-700">Hadir</span>
                    <span class="text-2xl font-bold text-blue-500">{{ $hadir }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-lg font-medium text-gray-700">Sakit</span>
                    <span class="text-2xl font-bold text-blue-500">{{ $sakit }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-lg font-medium text-gray-700">Izin</span>
                    <span class="text-2xl font-bold text-blue-500">{{ $izin }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-lg font-medium text-gray-700">Alpha</span>
                    <span class="text-2xl font-bold text-blue-500">{{ $alpha }}</span>
                </div>
                <div class="border-t border-gray-200 pt-5">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-medium text-gray-700">Belum Absen</span>
                        <span class="text-2xl font-bold text-gray-400">{{ $belumAbsen }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- BARIS SELANJUTNYA  --}}
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="bg-white p-6 rounded-lg shadow-xl relative">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Karyawan per Dept.</h2>
            <div class="w-full max-w-lg mx-auto min-h-[300px] flex items-center justify-center">
                <canvas id="departmentChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-xl relative">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Tren Kehadiran (30 Hari)</h2>
            <div class="w-full mx-auto min-h-[300px] flex items-center justify-center">
                <canvas id="attendanceTrendChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-xl relative">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Gaji per Dept. (Bulan Lalu)</h2>
            <div class="w-full mx-auto min-h-[300px] flex items-center justify-center">
                <canvas id="salaryByDeptChart"></canvas>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // =============================================
            // SKRIP UNTUK PIE CHART (Karyawan per Dept)
            // =============================================
            try {
                const pieLabels = @json($chartLabels);
                const pieData = @json($chartData);
                const pieCtx = document.getElementById('departmentChart').getContext('2d');

                const totalEmployees = @json($totalEmployees);

                const centerTextPlugin = {
                    id: 'centerText',
                    beforeDraw: (chart) => {
                        if (chart.config.type !== 'doughnut') return;

                        const ctx = chart.ctx;
                        ctx.restore();

                        // Ambil posisi tengah doughnut secara akurat
                        const xCenter = chart.getDatasetMeta(0).data[0].x;
                        const yCenter = chart.getDatasetMeta(0).data[0].y;

                        // Teks 1: "Total Karyawan"
                        ctx.font = '16px Poppins';
                        ctx.fillStyle = '#6B7280'; // text-gray-500
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.fillText('Total Karyawan', xCenter, yCenter - 15); // Sesuaikan offset Y

                        // Teks 2: Angka Total
                        ctx.font = 'bold 32px Poppins';
                        ctx.fillStyle = '#1F2937'; // text-gray-800
                        ctx.fillText(totalEmployees, xCenter, yCenter + 15); // Sesuaikan offset Y

                        ctx.save();
                    }
                };

                const backgroundColors = [
                    '#4299E1', '#48BB78', '#F6E05E', '#FC8181', '#805AD5',
                    '#ED8936', '#4FD1C5', '#F6AD55', '#667EEA', '#718096'
                ];

                new Chart(pieCtx, {
                    type: 'doughnut',
                    data: {
                        labels: pieLabels,
                        datasets: [{
                            label: 'Jumlah Karyawan',
                            data: pieData,
                            backgroundColor: backgroundColors.slice(0, pieLabels.length),
                            borderColor: '#ffffff',
                            borderWidth: 2,
                            hoverOffset: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        // Memotong lubang di tengah (0% = pie, 50% = default doughnut)
                        cutout: '70%',
                        plugins: {
                            legend: {
                                position: 'right',
                                labels: {
                                    font: {
                                        size: 14,
                                        family: 'Poppins'
                                    },
                                    color: '#4A5568'
                                }
                            },
                            tooltip: {
                                /* ... (opsi tooltip Anda) ... */
                            }
                        },
                        layout: {
                            padding: 10
                        }
                    },
                    // 👇 DAFTARKAN PLUGIN BARU ANDA DI SINI 👇
                    plugins: [centerTextPlugin]
                });
            } catch (e) {
                console.error('Gagal me-render Pie Chart:', e);
            }

            // =============================================
            // SKRIP UNTUK LINE CHART (Tren Kehadiran)
            // =============================================
            try {
                const trendLabels = @json($trendLabels);
                const trendData = @json($trendData);
                // ... (sisa kode line chart Anda tidak berubah) ...
                const trendCtx = document.getElementById('attendanceTrendChart').getContext('2d');
                new Chart(trendCtx, {
                    type: 'line',
                    data: {
                        labels: trendLabels,
                        datasets: [{
                            label: 'Jumlah Kehadiran',
                            data: trendData,
                            fill: true,
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderColor: '#3B82F6',
                            borderWidth: 2,
                            tension: 0.1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            },
                            x: {
                                ticks: {
                                    maxTicksLimit: 10
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            } catch (e) {
                console.error('Gagal me-render Line Chart:', e);
            }

            // =============================================
            // SKRIP UNTUK BAR CHART (Salary per dept)
            // ============================================= 
            try {
                const salaryLabels = @json($salaryLabels);
                const salaryData = @json($salaryData);
                const salaryCtx = document.getElementById('salaryByDeptChart').getContext('2d');

                // Ambil palet warna yang sama dari Pie Chart
                const backgroundColors = [
                    '#4299E1', '#48BB78', '#F6E05E', '#FC8181', '#805AD5',
                    '#ED8936', '#4FD1C5', '#F6AD55', '#667EEA', '#718096'
                ];

                new Chart(salaryCtx, {
                    type: 'bar',
                    data: {
                        labels: salaryLabels,
                        datasets: [{
                            label: 'Total Gaji',
                            data: salaryData,
                            backgroundColor: backgroundColors.slice(0, salaryLabels.length),
                            borderColor: backgroundColors.map(color => color.slice(0, 7) +
                                'CC'), // Tambah transparansi
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    // Format angka sumbu Y sebagai mata uang (opsional tapi bagus)
                                    callback: function(value, index, values) {
                                        // Tampilkan dalam format 'Jt' (Juta)
                                        return (value / 1000000) + ' Jt';
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false // Sembunyikan legenda, sudah jelas
                            },
                            tooltip: {
                                callbacks: {
                                    // Format tooltip sebagai Rupiah
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.parsed.y !== null) {
                                            label += new Intl.NumberFormat('id-ID', {
                                                style: 'currency',
                                                currency: 'IDR',
                                                maximumFractionDigits: 0
                                            }).format(context.parsed.y);
                                        }
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            } catch (e) {
                console.error('Gagal me-render Bar Chart:', e);
            }

        });
    </script>
@endsection
