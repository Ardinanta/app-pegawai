@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Departemen</h2>
            <a href="{{ route('departments.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                + Tambah Departemen
            </a>
        </div>

        <x-search-form :action="route('departments.index')" placeholder="Cari nama, email, atau departemen..." />

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
                        <th class="py-3 px-6 text-left">Nama Departemen</th>
                        <th class="py-3 px-6 text-center"></th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($departments as $department)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="py-3 px-6 text-left">{{ $department->nama_departemen }}</td>
                            <td class="py-3 px-6 text-center">
                                <form action="{{ route('departments.destroy', $department->id) }}" method="POST"
                                    class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('departments.edit', $department->id) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded text-xs transition duration-300">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-xs transition duration-300"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">Belum ada data departemen.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="py-4">
            {{ $departments->links() }}
        </div>
    </div>
@endsection
