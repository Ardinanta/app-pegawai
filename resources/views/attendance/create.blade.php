@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">
                Absensi Karyawan ({{ \Carbon\Carbon::now()->translatedFormat('d F Y') }})
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('attendances.createManual') }}"
                    class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-0.5">
                    Izin/Sakit
                </a>
                <a href="{{ route('attendances.index') }}"
                    class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- Notifikasi Sukses --}}
        @if ($message = Session::get('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span>{{ $message }}</span>
            </div>
        @endif

        {{-- Notifikasi Error --}}
        @if ($message = Session::get('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span>{{ $message }}</span>
            </div>
        @endif

        {{-- Tabel Aksi Massal --}}
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">Nama Karyawan</th>
                        <th class="py-3 px-6 text-left">Jabatan</th>
                        <th class="py-3 px-6 text-center">Status Hari Ini</th>
                        <th class="py-3 px-6 text-center">Waktu Masuk</th>
                        <th class="py-3 px-6 text-center">Waktu Keluar</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">

                    @forelse ($employees as $employee)
                        @php
                            $todayAttendance = $employee->attendances->first();
                        @endphp

                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-6 text-left font-medium">{{ $employee->nama_lengkap }}</td>
                            <td class="py-3 px-6 text-left">{{ $employee->position->nama_jabatan }}</td>

                            {{-- Kolom Status --}}
                            <td class="py-3 px-6 text-center">
                                @if ($todayAttendance)
                                    @php
                                        $status = strtolower($todayAttendance->status_absensi);
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
                                        {{ ucfirst($status) }}
                                    </span>
                                @else
                                    <span class="text-gray-400">- Belum Absen -</span>
                                @endif
                            </td>

                            {{-- Waktu Masuk --}}
                            <td class="py-3 px-6 text-center">
                                {{ $todayAttendance && $todayAttendance->waktu_masuk ? \Carbon\Carbon::parse($todayAttendance->waktu_masuk)->format('H:i') : '-' }}
                            </td>

                            {{-- Waktu Keluar --}}
                            <td class="py-3 px-6 text-center">
                                {{ $todayAttendance && $todayAttendance->waktu_keluar ? \Carbon\Carbon::parse($todayAttendance->waktu_keluar)->format('H:i') : '-' }}
                            </td>

                            {{-- Kolom Aksi (Tombol) --}}
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    @if (!$todayAttendance || !$todayAttendance->waktu_masuk)
                                        {{-- Tampilkan Tombol HADIR jika belum ada data ATAU belum clock in --}}
                                        <form action="{{ route('attendances.clockIn', $employee->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded text-xs transition duration-300">
                                                Hadir
                                            </button>
                                        </form>
                                    @elseif ($todayAttendance && $todayAttendance->waktu_masuk && !$todayAttendance->waktu_keluar)
                                        {{-- Tampilkan Tombol KELUAR jika sudah clock in TAPI belum clock out --}}
                                        <form action="{{ route('attendances.clockOut', $employee->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-xs transition duration-300">
                                                Keluar
                                            </button>
                                        </form>
                                    @else
                                        {{-- Sudah Selesai (Clock in dan Clock out) --}}
                                        <span class="text-gray-400 text-xs font-semibold">Selesai</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada data karyawan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
@endsection
