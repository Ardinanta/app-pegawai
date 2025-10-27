<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('employee')->latest('tanggal')->paginate(15);
        return view('attendance.index', compact('attendances'));
    }

    public function create()
    {
        $employees = Employee::orderBy('nama_lengkap')->get();
        // Definisikan status di sini agar mudah dikelola
        $statuses = ['Hadir', 'Sakit', 'Izin', 'Alpha'];
        return view('attendance.create', compact('employees', 'statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => [
                'required',
                // Pastikan tidak ada absensi ganda untuk karyawan yang sama di tanggal yang sama
                Rule::unique('attendances')->where(function ($query) use ($request) {
                    return $query->where('tanggal', $request->tanggal);
                }),
            ],
            'tanggal' => 'required|date',
            'status_absensi' => 'required|in:Hadir,Sakit,Izin,Alpha',
            // Waktu masuk wajib jika statusnya 'Hadir'
            'waktu_masuk' => 'required_if:status_absensi,Hadir|nullable|date_format:H:i',
            // Waktu keluar harus setelah waktu masuk
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
        
        // Jika status bukan 'Hadir', kosongkan waktu masuk dan keluar
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
}