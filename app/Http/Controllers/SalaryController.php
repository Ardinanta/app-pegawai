<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class SalaryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Ambil bulan terbaru dari semua data gaji
        $latestMonth = Salary::max('bulan');

        // Query untuk data yang akan ditampilkan (semua gaji di bulan terbaru)
        $salariesQuery = Salary::with('employee.position')
            ->where('bulan', $latestMonth)
            ->when($search, function ($query, $term) {
                $query->where(function ($q) use ($term) {
                    $q->where('bulan', 'like', "%{$term}%");
                })
                ->orWhereHas('employee', function ($q) use ($term) {
                    $q->where('nama_lengkap', 'like', "%{$term}%");
                });
            });

        // Hitung statistik dari keseluruhan data (sebelum pagination)
        $totalGaji = $salariesQuery->sum('total_gaji');
        $totalTunjangan = $salariesQuery->sum('tunjangan');
        $totalPotongan = $salariesQuery->sum('potongan');
        $jumlahKaryawan = $salariesQuery->count();

        // Ambil data dengan pagination
        $salaries = $salariesQuery
            ->latest('bulan')
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('salary.index', compact('salaries', 'totalGaji', 'totalTunjangan', 'totalPotongan', 'jumlahKaryawan', 'latestMonth'));
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

    public function downloadPdf(Salary $salary)
    {
        $salary->load('employee.position', 'employee.department');
        $pdf = Pdf::loadView('salary.pdf', compact('salary')); // <-- Pastikan 'Pdf' diawali huruf besar
        $fileName = 'slip-gaji-' . $salary->employee->nama_lengkap . '-' . $salary->bulan . '.pdf';
        return $pdf->download($fileName);
    }
}
