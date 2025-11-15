@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Gaji Karyawan</h2>
            <a href="{{ route('salaries.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                + Tambah Data Gaji
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
                                    class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('salaries.downloadPdf', $salary->id) }}"
                                        class="text-gray-500 hover:text-purple-600 transition duration-300"
                                        title="Unduh Slip Gaji (PDF)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg>
                                    </a>

                                    <a href="{{ route('salaries.edit', $salary->id) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded text-xs transition duration-300">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-xs transition duration-300"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
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
