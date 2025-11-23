@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Gaji Karyawan</h2>
            <a href="{{ route('salaries.create') }}"
                class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Data Gaji
            </a>
        </div>

        <x-search-form 
    :action="route('salaries.index')" 
    placeholder="Cari nama, email, atau departemen..." 
/>

        @if ($message = Session::get('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span>{{ $message }}</span>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">Nama Karyawan</th>
                        <th class="py-3 px-6 text-left">Bulan</th>
                        <th class="py-3 px-6 text-left">Gaji Pokok</th>
                        <th class="py-3 px-6 text-left">Tunjangan</th>
                        <th class="py-3 px-6 text-left">Potongan</th>
                        <th class="py-3 px-6 text-left">Total Gaji</th>
                        <th class="py-3 px-6 text-center"></th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($salaries as $salary)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left font-medium">{{ $salary->employee->nama_lengkap }}</td>
                            <td class="py-3 px-6 text-left">{{ \Carbon\Carbon::parse($salary->bulan)->format('F Y') }}</td>
                            <td class="py-3 px-6 text-left">Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-left text-green-600">+ Rp
                                {{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-left text-red-600">- Rp
                                {{ number_format($salary->potongan, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-left font-semibold">Rp
                                {{ number_format($salary->total_gaji, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-center">
                                <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST"
                                    class="flex items-center justify-center gap-3">
                                    <a href="{{ route('salaries.downloadPdf', $salary->id) }}"
                                        class="inline-flex items-center justify-center bg-purple-600 hover:bg-purple-700 text-white font-semibold py-1.5 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-0.5"
                                        title="Unduh Slip Gaji (PDF)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg>
                                    </a>

                                    <a href="{{ route('salaries.edit', $salary->id) }}"
                                        class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1.5 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-0.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        Edit
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center gap-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-1.5 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-0.5"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            {{-- 👇 Colspan disesuaikan menjadi 7 --}}
                            <td colspan="7" class="text-center py-4">Belum ada data gaji.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $salaries->links() }}
        </div>
    </div>
@endsection
