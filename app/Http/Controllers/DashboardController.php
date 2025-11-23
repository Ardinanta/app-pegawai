<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; // <-- TAMBAHKAN INI

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::where('status', 'aktif')->count();
        $totalDepartments = Department::count();
        $totalPositions = Position::count();
        $presentToday = Attendance::where('tanggal', Carbon::today()->toDateString())
            ->where('status_absensi', 'Hadir')
            ->count();

        // PIE CHART
        $departmentData = Department::withCount(['employees' => function ($query) {
            $query->where('status', 'aktif');
        }])->get();

        $chartLabels = $departmentData->pluck('nama_departemen');
        $chartData = $departmentData->pluck('employees_count');
        //PIE CHART END

        // LINE CHART 
        $attendanceTrend = Attendance::where('status_absensi', 'Hadir')
            ->where('tanggal', '>=', Carbon::now()->subDays(30)) // Ambil data 30 hari terakhir
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get([
                DB::raw('DATE(tanggal) as date'),
                DB::raw('COUNT(*) as count')
            ]);

        $trendLabels = $attendanceTrend->pluck('date');
        $trendData = $attendanceTrend->pluck('count');
        // LINE CHART END

        // SALARY PER DEPT 
        $lastMonth = Carbon::now()->subMonth()->format('Y-m'); // Format: '2025-10'
        $salaryByDept = Department::withSum(['salaries' => function ($query) use ($lastMonth) {
            $query->where('bulan', $lastMonth);
        }], 'total_gaji') // <-- Hanya 'salaries'
            ->orderBy('salaries_sum_total_gaji', 'desc') // <-- Ubah nama kolom 'order by'
            ->get();

        $salaryLabels = $salaryByDept->pluck('nama_departemen');
        $salaryData = $salaryByDept->pluck('salaries_sum_total_gaji'); // <-- Ubah nama kolom 'pluck'
        // SALARY PER DEPT END

        // EMPLOYEES ABSENT
        $today = Carbon::today()->toDateString();
        $totalEmployees = Employee::where('status', 'aktif')->count();
        // ... (Query untuk 3 Chart Anda) ...

        // 1. Data untuk Widget Kiri (Karyawan Tidak Hadir)
        $absentToday = Attendance::with(['employee.position', 'employee.department'])
            ->where('tanggal', $today)
            ->whereIn('status_absensi', ['sakit', 'izin']) 
            ->get();

        // 2. Data untuk Widget Kanan (Ringkasan Hari Ini)
        $attendanceSummary = Attendance::where('tanggal', $today)
            ->select('status_absensi', DB::raw('count(*) as total'))
            ->groupBy('status_absensi')
            ->get()
            ->pluck('total', 'status_absensi');
        // EMPLOYEES ABSENT END


        return view('dashboard', compact(
            'totalEmployees',
            'totalDepartments',
            'totalPositions',
            'presentToday',
            'chartLabels',
            'chartData',
            'trendLabels',
            'trendData',
            'salaryLabels',
            'salaryData',
            'absentToday',
            'attendanceSummary'
        ));
    }
}
