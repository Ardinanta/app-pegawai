<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $attendances = Attendance::with('employee')
            ->when($search, function ($query, $term) {
                $query->where(function ($q) use ($term) {
                    $q->where('tanggal', 'like', "%{$term}%")
                        ->orWhere('status_absensi', 'like', "%{$term}%");
                })
                    ->orWhereHas('employee', function ($q) use ($term) {
                        $q->where('nama_lengkap', 'like', "%{$term}%");
                    });
            })
            ->latest('tanggal')
            ->paginate(15)
            ->appends(['search' => $search]);

        return view('attendance.index', compact('attendances'));
    }

    public function create(Request $request)
    {
        $today = Carbon::today();

        $employees = Employee::with('position')
            ->with(['attendances' => function ($query) use ($today) {
                $query->where('tanggal', $today);
            }])
            ->search($request)
            ->orderBy('nama_lengkap')
            ->paginate(10)
            ->appends($request->query());

        return view('attendance.create', compact('employees'));
    }

    public function createManual()
    {
        $employees = Employee::orderBy('nama_lengkap')->get();
        $statuses = ['Sakit', 'Izin', 'Alpha'];

        return view('attendance.create_manual', compact('employees', 'statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => [
                'required',
                Rule::unique('attendances')->where(function ($query) use ($request) {
                    return $query->where('tanggal', $request->tanggal);
                }),
            ],
            'tanggal' => 'required|date',
            'status_absensi' => 'required|in:Hadir,Sakit,Izin,Alpha',
            'waktu_masuk' => 'required_if:status_absensi,Hadir|nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i|after:waktu_masuk',
        ], [
            'karyawan_id.unique' => 'Karyawan ini sudah memiliki data absensi pada tanggal tersebut.'
        ]);

        Attendance::create($request->all());

        return redirect()->route('attendances.index')
            ->with('success', 'Data absensi berhasil ditambahkan.');
    }

    public function edit(Attendance $attendance)
    {
        $employees = Employee::orderBy('nama_lengkap')->get();
        $statuses = ['Hadir', 'Sakit', 'Izin', 'Alpha'];
        return view('attendance.edit', compact('attendance', 'employees', 'statuses'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'karyawan_id' => [
                'required',
                Rule::unique('attendances')->where(function ($query) use ($request) {
                    return $query->where('tanggal', $request->tanggal);
                })->ignore($attendance->id),
            ],
            'tanggal' => 'required|date',
            'status_absensi' => 'required|in:Hadir,Sakit,Izin,Alpha',
            'waktu_masuk' => 'required_if:status_absensi,Hadir|nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i|after:waktu_masuk',
        ], [
            'karyawan_id.unique' => 'Karyawan ini sudah memiliki data absensi pada tanggal tersebut.'
        ]);

        $data = $request->all();
        if ($request->status_absensi !== 'Hadir') {
            $data['waktu_masuk'] = null;
            $data['waktu_keluar'] = null;
        }

        $attendance->update($data);

        return redirect()->route('attendances.index')
            ->with('success', 'Data absensi berhasil diperbarui.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')
            ->with('success', 'Data absensi berhasil dihapus.');
    }

    public function clockIn(Request $request, Employee $employee)
    {
        $today = Carbon::today()->toDateString();
        $now = Carbon::now();

        $attendance = Attendance::where('karyawan_id', $employee->id)
            ->where('tanggal', $today)
            ->first();

        if ($attendance) {
            if ($attendance->waktu_masuk) {
                return redirect()->back()->with('error', $employee->nama_lengkap . ' sudah clock-in hari ini.');
            }
            $attendance->update([
                'waktu_masuk' => $now,
                'status_absensi' => 'hadir',
            ]);
        } else {
            Attendance::create([
                'karyawan_id' => $employee->id,
                'tanggal' => $today,
                'waktu_masuk' => $now,
                'status_absensi' => 'hadir',
            ]);
        }

        return redirect()->back()->with('success', $employee->nama_lengkap . ' berhasil clock-in.');
    }

    public function clockOut(Request $request, Employee $employee)
    {
        $today = Carbon::today()->toDateString();
        $now = Carbon::now();

        $attendance = Attendance::where('karyawan_id', $employee->id)
            ->where('tanggal', $today)
            ->first();

        if (!$attendance || !$attendance->waktu_masuk) {
            return redirect()->back()->with('error', $employee->nama_lengkap . ' belum clock-in hari ini.');
        }

        if ($attendance->waktu_keluar) {
            return redirect()->back()->with('error', $employee->nama_lengkap . ' sudah clock-out hari ini.');
        }

        $attendance->update([
            'waktu_keluar' => $now,
        ]);

        return redirect()->back()->with('success', $employee->nama_lengkap . ' berhasil clock-out.');
    }
}
