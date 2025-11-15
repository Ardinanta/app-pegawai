@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Jabatan</h2>
        <a href="{{ route('positions.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-300">
            + Tambah Jabatan
        </a>
    </div>

    <x-search-form 
    :action="route('positions.index')" 
    placeholder="Cari nama, email, atau departemen..." 
/>
    {{-- Pesan Sukses --}}
    @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ $message }}</span>
        </div>
    @endif

    {{-- Tabel Data --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="py-3 px-6 text-left">No</th>
                    <th class="py-3 px-6 text-left">Nama Jabatan</th>
                    <th class="py-3 px-6 text-left">Gaji Pokok</th>
                    <th class="py-3 px-6 text-center"></th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($positions as $position)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">{{ $positions->firstItem() + $loop->index }}</td>
                    <td class="py-3 px-6 text-left">{{ $position->nama_jabatan }}</td>
                    <td class="py-3 px-6 text-left">Rp {{ number_format($position->gaji_pokok, 2, ',', '.') }}</td>
                    <td class="py-3 px-6 text-center">
                        <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="flex items-center justify-center space-x-2">
                            <a href="{{ route('positions.edit', $position->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded text-xs transition duration-300">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-xs transition duration-300" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
            {{ $positions->links() }}
    </div>
</div>
@endsection
