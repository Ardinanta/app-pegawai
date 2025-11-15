@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Absensi Karyawan</h2>
            <a href="{{ route('attendances.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                Catat Absensi
            </a>
        </div>

        <x-search-form :action="route('attendances.index')" placeholder="Cari nama, email, atau departemen..." />

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
                        <th class="py-3 px-6 text-left">Tanggal</th>
                        <th class="py-3 px-6 text-center">Status</th>
                        <th class="py-3 px-6 text-left">Waktu Masuk</th>
                        <th class="py-3 px-6 text-left">Waktu Keluar</th>
                        <th class="py-3 px-6 text-center"></th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($attendances as $attendance)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left font-medium">{{ $attendance->employee->nama_lengkap }}</td>
                            <td class="py-3 px-6 text-left">
                                {{ \Carbon\Carbon::parse($attendance->tanggal)->translatedFormat('d F Y') }}</td>
                            <td class="py-3 px-6 text-center">
                                @php
                                    $status = strtolower($attendance->status_absensi);
                                    $color = '';

                                    if ($status == 'hadir') {
                                        $color = 'bg-green-200 text-green-800';
                                    } elseif ($status == 'sakit') {
                                        $color = 'bg-yellow-200 text-yellow-800';
                                    } elseif ($status == 'izin') {
                                        $color = 'bg-blue-200 text-blue-800';
                                    } else {
                                        $color = 'bg-red-200 text-red-800';
                                    }
                                @endphp
                                <span
                                    class="px-2 py-1 font-semibold leading-tight rounded-full text-xs {{ $color }}">
                                    {{ $status }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $attendance->waktu_masuk ? \Carbon\Carbon::parse($attendance->waktu_masuk)->format('H:i') : '-' }}
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $attendance->waktu_keluar ? \Carbon\Carbon::parse($attendance->waktu_keluar)->format('H:i') : '-' }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST"
                                    class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('attendances.edit', $attendance->id) }}"
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
                            <td colspan="6" class="text-center py-4">Belum ada data absensi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $attendances->links() }}
        </div>
    </div>
@endsection
