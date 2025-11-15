@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Catat Absensi Manual (Sakit/Izin/Alpha)</h2>
        <a href="{{ route('attendances.create') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-300">
            Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong>Ups!</strong> Terjadi kesalahan:<br><br>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('attendances.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="karyawan_id" class="block text-gray-700 text-sm font-bold mb-2">Pilih Karyawan:</label>
                <select name="karyawan_id" id="karyawan_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">-- Pilih Karyawan --</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('karyawan_id') == $employee->id ? 'selected' : '' }}>{{ $employee->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="tanggal" class="block text-gray-700 text-sm font-bold mb-2">Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="md:col-span-2">
                <label for="status_absensi" class="block text-gray-700 text-sm font-bold mb-2">Status Kehadiran:</label>
                <select name="status_absensi" id="status_absensi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ old('status_absensi') == $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="waktu_masuk" value="">
            <input type="hidden" name="waktu_keluar" value="">
        </div>

        <div class="text-right mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection