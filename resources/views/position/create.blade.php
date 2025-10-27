@extends('layouts.app')

    @section('content')
        <div class="bg-white p-6 rounded-lg shadow-md">
            {{-- Header --}}
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Tambah Jabatan Baru</h2>
                <a href="{{ route('positions.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                    Kembali
                </a>
            </div>

            {{-- Notifikasi Error --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong>Ups!</strong> Terjadi kesalahan dengan input Anda.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Tambah Data --}}
            <form action="{{ route('positions.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="nama_jabatan" class="block text-gray-700 text-sm font-bold mb-2">Nama Jabatan:</label>
                        <input type="text" name="nama_jabatan" id="nama_jabatan"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Contoh: Manajer Pemasaran">
                    </div>
                    <div>
                        <label for="gaji_pokok" class="block text-gray-700 text-sm font-bold mb-2">Gaji Pokok:</label>
                        <input type="number" name="gaji_pokok" id="gaji_pokok" step="1000"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Contoh: 5000000">
                    </div>
                    <div class="text-right">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                            Simpan </button>
                    </div>
                </div>
                
            </form>
        </div>
    @endsection