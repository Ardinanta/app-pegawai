<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $positions = Position::query() // Mulai kueri
            ->when($search, function ($query, $term) {
                // Cari hanya di kolom 'nama_jabatan'
                $query->where('nama_jabatan', 'like', "%{$term}%");
            })
            ->latest() // Mengurutkan dari yang terbaru
            ->paginate(10) // Menggunakan paginate (bukan 'all()')
            ->appends(['search' => $search]); // Menjaga 'search' di pagination

        return view('position.index', compact('positions'));
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
