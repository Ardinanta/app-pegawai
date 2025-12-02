@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-xl shadow-lg p-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-white">
                        Pencatatan Absensi
                    </h2>
                    <p class="text-indigo-100 text-sm mt-1 font-medium">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('attendances.create.manual') }}"
                        class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-semibold py-2.5 px-5 rounded-lg shadow-sm hover:shadow transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Izin/Sakit
                    </a>
                    <a href="{{ route('attendances.index') }}"
                        class="inline-flex items-center gap-2 bg-white text-indigo-700 hover:bg-indigo-50 font-semibold py-2.5 px-5 rounded-lg shadow-sm hover:shadow transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        {{-- Notifikasi Sukses --}}
        @if ($message = Session::get('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-r shadow-sm" role="alert">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ $message }}</span>
                </div>
            </div>
        @endif

        {{-- Notifikasi Error --}}
        @if ($message = Session::get('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r shadow-sm" role="alert">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ $message }}</span>
                </div>
            </div>
        @endif

        {{-- Tabel Karyawan --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama Karyawan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Jabatan</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Status Hari Ini</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Waktu Masuk</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Waktu Keluar</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($employees as $employee)
                        @php
                            $todayAttendance = $employee->attendances->first();
                        @endphp

                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-indigo-500 flex items-center justify-center">
                                            <span class="text-white font-semibold text-sm">{{ strtoupper(substr($employee->nama_lengkap, 0, 2)) }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $employee->nama_lengkap }}</p>
                                        <p class="text-xs text-gray-500">{{ $employee->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-700 font-medium">{{ $employee->position->nama_jabatan }}</span>
                            </td>

                            {{-- Kolom Status --}}
                            <td class="px-6 py-4 text-center">
                                @if ($todayAttendance)
                                    @php
                                        $status = strtolower($todayAttendance->status_absensi);
                                        $statusConfig = [
                                            'hadir' => ['label' => 'Hadir', 'class' => 'bg-green-100 text-green-800'],
                                            'sakit' => ['label' => 'Sakit', 'class' => 'bg-yellow-100 text-yellow-800'],
                                            'izin' => ['label' => 'Izin', 'class' => 'bg-blue-100 text-blue-800'],
                                            'alpha' => ['label' => 'Alpha', 'class' => 'bg-red-100 text-red-800'],
                                        ];
                                        $config = $statusConfig[$status] ?? ['label' => ucfirst($status), 'class' => 'bg-gray-100 text-gray-800'];
                                    @endphp
                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full {{ $config['class'] }}">
                                        {{ $config['label'] }}
                                    </span>
                                @else
                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-600">
                                        Belum Absen
                                    </span>
                                @endif
                            </td>

                            {{-- Waktu Masuk --}}
                            <td class="px-6 py-4 text-center">
                                @if($todayAttendance && $todayAttendance->waktu_masuk)
                                    <span class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($todayAttendance->waktu_masuk)->format('H:i') }}</span>
                                @else
                                    <span class="text-sm text-gray-400">-</span>
                                @endif
                            </td>

                            {{-- Waktu Keluar --}}
                            <td class="px-6 py-4 text-center">
                                @if($todayAttendance && $todayAttendance->waktu_keluar)
                                    <span class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($todayAttendance->waktu_keluar)->format('H:i') }}</span>
                                @else
                                    <span class="text-sm text-gray-400">-</span>
                                @endif
                            </td>

                            {{-- Kolom Aksi (Tombol) --}}
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    @if (!$todayAttendance || !$todayAttendance->waktu_masuk)
                                        {{-- Tampilkan Tombol HADIR jika belum ada data ATAU belum clock in --}}
                                        <form action="{{ route('attendances.clock-in', $employee->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-xs font-semibold rounded-lg shadow-sm hover:shadow transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Clock In
                                            </button>
                                        </form>
                                    @elseif ($todayAttendance && $todayAttendance->waktu_masuk && !$todayAttendance->waktu_keluar)
                                        {{-- Tampilkan Tombol KELUAR jika sudah clock in TAPI belum clock out --}}
                                        <form action="{{ route('attendances.clock-out', $employee->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold rounded-lg shadow-sm hover:shadow transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                                Clock Out
                                            </button>
                                        </form>
                                    @else
                                        {{-- Sudah Selesai (Clock in dan Clock out) --}}
                                        <span class="inline-flex items-center gap-1.5 px-4 py-2 bg-gray-100 text-gray-600 text-xs font-semibold rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Selesai
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-600 font-medium">Belum ada data karyawan</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($employees->hasPages())
            <div>
                {{ $employees->links() }}
            </div>
        @endif
    </div>
@endsection
