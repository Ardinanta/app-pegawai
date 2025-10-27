@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Detail Karyawan</h2>
        <a href="{{ route('employees.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-300">
            Kembali
        </a>
    </div>

    {{-- Garis Pemisah --}}
    <div class="border-t border-gray-200 pt-4 mt-4">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-8">
            {{-- Informasi Pribadi --}}
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $employee->nama_lengkap }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Email</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $employee->email }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Nomor Telepon</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $employee->nomor_telepon }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Tanggal Lahir</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ \Carbon\Carbon::parse($employee->tanggal_lahir)->translatedFormat('d F Y') }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $employee->alamat }}</dd>
            </div>

            {{-- Informasi Pekerjaan --}}
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Departemen</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $employee->department->nama_departemen }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Jabatan</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ $employee->position->nama_jabatan }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Tanggal Masuk</dt>
                <dd class="mt-1 text-lg text-gray-900">{{ \Carbon\Carbon::parse($employee->tanggal_masuk)->translatedFormat('d F Y') }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Status</dt>
                <dd class="mt-1 text-lg">
                    @if($employee->status == 'aktif')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Aktif
                        </span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Tidak Aktif
                        </span>
                    @endif
                </dd>
            </div>
        </dl>
    </div>
</div>
@endsection
