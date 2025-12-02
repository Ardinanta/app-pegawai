<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Query untuk data
        $positionsQuery = Position::query()
            ->when($search, function ($query, $term) {
                $query->where('nama_jabatan', 'like', "%{$term}%");
            });

        // Hitung statistik dari keseluruhan data (sebelum pagination)
        $totalPositions = $positionsQuery->count();
        $maxSalary = $positionsQuery->max('gaji_pokok') ?? 0;
        $minSalary = $positionsQuery->min('gaji_pokok') ?? 0;

        // Ambil data dengan pagination
        $positions = $positionsQuery
            ->latest() 
            ->paginate(10)
            ->appends(['search' => $search]); 

        return view('position.index', compact('positions', 'totalPositions', 'maxSalary', 'minSalary'));
    }

    public function create()
    {
        return view('position.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required',
            'gaji_pokok' => 'required|numeric'
        ]);
        Position::create($request->all());
        return redirect()->route('positions.index');
    }

    public function edit(Position $position)
    {
        return view('position.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $position->update($request->all());
        return redirect()->route('positions.index');
    }

    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('positions.index');
    }
}
