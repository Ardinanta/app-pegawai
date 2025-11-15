@extends('layouts.app')

@section('content')
    {{-- header  --}}
    <div class="px-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">Daftar Karyawan</h1>
            <div class="flex space-x-2">
                <a href="{{ route('employees.create') }}"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                    + Tambah Karyawan
                </a>
            </div>
        </div>

        {{-- search --}}
        <x-search-form :action="route('employees.index')" placeholder="Cari nama, email, atau departemen..." />
        @if ($message = Session::get('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ $message }}</p>
            </div>
        @endif

        {{-- data  --}}
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                No</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nama Lengkap</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Email</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Departemen</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Jabatan</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                            <tr class="hover:bg-gray-50">
                                <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">{{ $employees->firstItem() + $loop->index }}</td>
                                <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                                    {{ $employee->nama_lengkap }}</td>
                                <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">{{ $employee->email }}</td>
                                <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                                    {{ $employee->department->nama_departemen }}</td>
                                <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                                    {{ $employee->position->nama_jabatan }}</td>

                                <td class="py-3 px-6 text-center border-b">
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                        class="flex items-center justify-start space-x-4">

                                        {{-- Tombol SHOW --}}
                                        <a href="{{ route('employees.show', $employee->id) }}"
                                            class="text-blue-500 hover:text-blue-700 transition duration-300"
                                            title="Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>

                                        {{-- Tombol EDIT --}}
                                        <a href="{{ route('employees.edit', $employee->id) }}"
                                            class="text-green-500 hover:text-green-700 transition duration-300"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.225 0 015.25 6H10" />
                                            </svg>
                                        </a>

                                        @csrf
                                        @method('DELETE')

                                        {{-- Tombol DELETE --}}
                                        <button type="submit"
                                            class="text-red-500 hover:text-red-700 transition duration-300" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12.977 0c-.34-.059-.68-.114-1.022-.165m10.02 0l-1.78-1.78a2.25 2.25 0 00-3.182 0l-1.78 1.78m10.02 0a48.452 48.452 0 01-5.022 0m-10.02 0c-1.83.01-3.657.062-5.48.182m15.48 0A48.45 48.45 0 0112 5.5m0 0a48.45 48.45 0 00-5.022 0m5.022 0a48.45 48.45 0 005.022 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="text-center py-10 px-5 border-b border-gray-200 bg-white text-sm text-gray-500">
                                    Belum ada data karyawan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="py-4">
            {{ $employees->links() }}
        </div>
    </div>
@endsection
