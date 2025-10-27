<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::with('employee')->latest()->paginate(10);
        return view('salary.index', compact('salaries'));
    }

    public function create()
    {
        $employees = Employee::with('position')->orderBy('nama_lengkap')->get();
        return view('salary.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => [
                'required',
                Rule::unique('salaries')->where(function ($query) use ($request) {
                    return $query->where('bulan', $request->bulan);
                }),
            ],
            'bulan' => 'required|date_format:Y-m',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ]);

        $data = $request->all();

        $gaji_pokok = $data['gaji_pokok'] ?? 0;
        $tunjangan = $data['tunjangan'] ?? 0;
        $potongan = $data['potongan'] ?? 0;
        $data['total_gaji'] = ($gaji_pokok + $tunjangan) - $potongan;

        Salary::create($data);

        return redirect()->route('salaries.index')
            ->with('success', 'Data gaji berhasil ditambahkan.');
    }

    public function edit(Salary $salary)
    {
        $employees = Employee::with('position')->orderBy('nama_lengkap')->get();
        return view('salary.edit', compact('salary', 'employees'));
    }

    public function update(Request $request, Salary $salary)
    {
        $request->validate([
            'karyawan_id' => [
                'required',
                Rule::unique('salaries')->where(function ($query) use ($request) {
                    return $query->where('bulan', $request->bulan);
                })->ignore($salary->id),
            ],
            'bulan' => 'required|date_format:Y-m',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ]);

        $data = $request->all();

        $gaji_pokok = $data['gaji_pokok'] ?? 0;
        $tunjangan = $data['tunjangan'] ?? 0;
        $potongan = $data['potongan'] ?? 0;
        $data['total_gaji'] = ($gaji_pokok + $tunjangan) - $potongan;

        $salary->update($data);

        return redirect()->route('salaries.index')
            ->with('success', 'Data gaji berhasil diperbarui.');
    }

    public function destroy(Salary $salary)
    {
        $salary->delete();
        return redirect()->route('salaries.index')
            ->with('success', 'Data gaji berhasil dihapus.');
    }
}
