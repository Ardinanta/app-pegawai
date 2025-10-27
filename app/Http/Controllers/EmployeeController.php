<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['department', 'position'])->latest()->paginate(10);
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('employee.create', compact('departments', 'positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'nomor_telepon' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'tanggal_masuk' => 'required|date',
            'departemen_id' => 'required|exists:departments,id',
            'jabatan_id' => 'required|exists:positions,id',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')
            ->with('success', 'Karyawan baru berhasil ditambahkan.');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('employee.edit', compact('employee', 'departments', 'positions'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'nomor_telepon' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'tanggal_masuk' => 'required|date',
            'departemen_id' => 'required|exists:departments,id',
            'jabatan_id' => 'required|exists:positions,id',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')
            ->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')
            ->with('success', 'Data karyawan berhasil dihapus.');
    }

    public function show(Employee $employee)
    {
        return view('employee.show', compact('employee'));
    }
}
