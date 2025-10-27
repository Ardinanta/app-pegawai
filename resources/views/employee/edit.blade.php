@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Edit Data Karyawan</h2>
        <a href="{{ route('employees.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-300">
            Kembali
        </a>
    </div>

    {{-- Notifikasi Error --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong>Ups!</strong> Terjadi kesalahan dengan input Anda.<br><br>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Edit Data --}}
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Kolom Kiri --}}
            <div>
                <label for="nama_lengkap" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap:</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ $employee->nama_lengkap }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" name="email" id="email" value="{{ $employee->email }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="nomor_telepon" class="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon:</label>
                <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ $employee->nomor_telepon }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="tanggal_lahir" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ $employee->tanggal_lahir }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat:</label>
                <textarea name="alamat" id="alamat" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $employee->alamat }}</textarea>
            </div>
            
            {{-- Kolom Kanan --}}
            <div>
                <label for="tanggal_masuk" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Masuk:</label>
                <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="{{ $employee->tanggal_masuk }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="departemen_id" class="block text-gray-700 text-sm font-bold mb-2">Departemen:</label>
                <select name="departemen_id" id="departemen_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ $employee->department_id == $department->id ? 'selected' : '' }}>{{ $department->nama_departemen }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="jabatan_id" class="block text-gray-700 text-sm font-bold mb-2">Jabatan:</label>
                <select name="jabatan_id" id="jabatan_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}" {{ $employee->position_id == $position->id ? 'selected' : '' }}>{{ $position->nama_jabatan }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="text-right mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
