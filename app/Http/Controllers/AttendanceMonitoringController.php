<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceMonitoringController extends Controller
{
    public function index(Request $request)
    {
        $selectedDate = $request->input('date', Carbon::today()->toDateString());
        $date = Carbon::parse($selectedDate);

        $departments = Department::with(['employees' => function ($query) {
            $query->where('status', 'aktif')
                  ->with('position')
                  ->orderBy('nama_lengkap');
        }])->orderBy('nama_departemen')->get();

        $attendances = Attendance::where('tanggal', $selectedDate)
            ->with('employee')
            ->get()
            ->keyBy('karyawan_id');

        $departmentsWithAttendance = $departments->map(function ($department) use ($attendances, $selectedDate) {
            $employees = $department->employees->map(function ($employee) use ($attendances, $selectedDate) {
                $attendance = $attendances->get($employee->id);
                
                return [
                    'id' => $employee->id,
                    'nama_lengkap' => $employee->nama_lengkap,
                    'email' => $employee->email,
                    'position' => $employee->position->nama_jabatan ?? '-',
                    'attendance' => $attendance ? [
                        'status' => $attendance->status_absensi,
                        'waktu_masuk' => $attendance->waktu_masuk,
                        'waktu_keluar' => $attendance->waktu_keluar,
                    ] : null,
                    'is_present' => $attendance && strtolower($attendance->status_absensi) === 'hadir',
                    'is_absent' => !$attendance || strtolower($attendance->status_absensi) === 'alpha',
                ];
            });

            // Calculate statistics
            $total = $employees->count();
            $present = $employees->where('is_present', true)->count();
            $absent = $employees->where('is_absent', true)->count();
            $sick = $employees->filter(function ($emp) {
                return $emp['attendance'] && strtolower($emp['attendance']['status']) === 'sakit';
            })->count();
            $permission = $employees->filter(function ($emp) {
                return $emp['attendance'] && strtolower($emp['attendance']['status']) === 'izin';
            })->count();

            return [
                'id' => $department->id,
                'nama_departemen' => $department->nama_departemen,
                'employees' => $employees,
                'statistics' => [
                    'total' => $total,
                    'present' => $present,
                    'absent' => $absent,
                    'sick' => $sick,
                    'permission' => $permission,
                ],
            ];
        });

        // Overall statistics
        $overallStats = [
            'total_employees' => Employee::where('status', 'aktif')->count(),
            'total_present' => $departmentsWithAttendance->sum(function ($dept) {
                return $dept['statistics']['present'];
            }),
            'total_absent' => $departmentsWithAttendance->sum(function ($dept) {
                return $dept['statistics']['absent'];
            }),
            'total_sick' => $departmentsWithAttendance->sum(function ($dept) {
                return $dept['statistics']['sick'];
            }),
            'total_permission' => $departmentsWithAttendance->sum(function ($dept) {
                return $dept['statistics']['permission'];
            }),
        ];

        return view('attendance-monitoring.index', compact(
            'departmentsWithAttendance',
            'overallStats',
            'selectedDate',
            'date'
        ));
    }
}

