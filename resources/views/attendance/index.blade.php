@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        {{-- Header --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Absensi</h1>
            <p class="mt-1 text-sm text-gray-600">
                Kelola dan pantau kehadiran karyawan
                @if($latestMonth)
                    <span class="ml-2 px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                        Periode: {{ \Carbon\Carbon::parse($latestMonth . '-01')->translatedFormat('F Y') }}
                    </span>
                @endif
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 sm:justify-between sm:items-center">
            <x-search-form :action="route('attendances.index')" placeholder="Cari nama pegawai..." />
            <a href="{{ route('attendances.create') }}"
                class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-5 rounded-lg shadow-md hover:shadow-lg transition-all whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span class="hidden sm:inline">Catat Absensi</span>
                <span class="sm:hidden">Catat</span>
            </a>
        </div>

        @if ($message = Session::get('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-r" role="alert">
                <p class="font-medium">{{ $message }}</p>
            </div>
        @endif

        {{-- Table --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Waktu Masuk</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Waktu Keluar</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($attendances as $attendance)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $attendances->firstItem() + $loop->index }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center">
                                                <span class="text-white font-semibold text-sm">{{ strtoupper(substr($attendance->employee->nama_lengkap, 0, 2)) }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-semibold text-gray-900">{{ $attendance->employee->nama_lengkap }}</p>
                                            <p class="text-xs text-gray-500">{{ $attendance->employee->department->nama_departemen ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ \Carbon\Carbon::parse($attendance->tanggal)->translatedFormat('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    @if ($attendance->status_absensi == 'hadir')
                                        <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Hadir</span>
                                    @elseif($attendance->status_absensi == 'sakit')
                                        <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Sakit</span>
                                    @elseif($attendance->status_absensi == 'izin')
                                        <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Izin</span>
                                    @else
                                        <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Alpha</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $attendance->waktu_masuk ? \Carbon\Carbon::parse($attendance->waktu_masuk)->format('H:i') : '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $attendance->waktu_keluar ? \Carbon\Carbon::parse($attendance->waktu_keluar)->format('H:i') : '-' }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('attendances.edit', $attendance->id) }}"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-lg transition-all shadow-sm hover:shadow" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded-lg transition-all shadow-sm hover:shadow" title="Hapus"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600 font-medium">Belum ada data absensi</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($attendances->hasPages())
            <div>
                {{ $attendances->links() }}
            </div>
        @endif
    </div>
@endsection
