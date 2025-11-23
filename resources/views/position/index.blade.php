@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Jabatan</h2>
        <a href="{{ route('positions.create') }}" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-0.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Jabatan
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
                        <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="flex items-center justify-center gap-3">
                            <a href="{{ route('positions.edit', $position->id) }}" class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1.5 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit
                            </a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-1.5 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-0.5" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Delete
                            </button>
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
