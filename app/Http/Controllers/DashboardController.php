<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::where('status', 'aktif')->count();
        $totalDepartments = Department::count();
        $totalPositions = Position::count();
        
        $today = Carbon::today()->toDateString();
        $presentToday = Attendance::where('tanggal', $today)
                                ->where('status_absensi', 'Hadir')
                                ->count();

        $newEmployees = Employee::with('position')
                                ->orderBy('tanggal_masuk', 'desc')
                                ->take(5)
                                ->get();
                                
        $absentToday = Attendance::with('employee')
                                ->where('tanggal', $today)
                                ->whereIn('status_absensi', ['Sakit', 'Izin'])
                                ->get();
        
        return view('dashboard', compact(
            'totalEmployees',
            'totalDepartments',
            'totalPositions',
            'presentToday',
            'newEmployees',
            'absentToday'
        ));
    }
}