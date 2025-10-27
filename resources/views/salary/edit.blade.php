@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Edit Data Gaji</h2>
        <a href="{{ route('salaries.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-300">
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

    <form action="{{ route('salaries.update', $salary->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="karyawan_id" class="block text-gray-700 text-sm font-bold mb-2">Pilih Karyawan:</label>
                <select name="karyawan_id" id="karyawan_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">-- Pilih Karyawan --</option>
                    @foreach($employees as $employee)
                        <option 
                            value="{{ $employee->id }}" 
                            data-gajipokok="{{ $employee->position->gaji_pokok ?? 0 }}"
                            {{ $salary->karyawan_id == $employee->id ? 'selected' : '' }}>
                            {{ $employee->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="bulan" class="block text-gray-700 text-sm font-bold mb-2">Bulan:</label>
                <input type="month" name="bulan" id="bulan" value="{{ $salary->bulan }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="gaji_pokok" class="block text-gray-700 text-sm font-bold mb-2">Gaji Pokok:</label>
                <input type="number" name="gaji_pokok" id="gaji_pokok" value="{{ $salary->gaji_pokok }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="tunjangan" class="block text-gray-700 text-sm font-bold mb-2">Tunjangan:</label>
                <input type="number" name="tunjangan" id="tunjangan" value="{{ $salary->tunjangan }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="potongan" class="block text-gray-700 text-sm font-bold mb-2">Potongan:</label>
                <input type="number" name="potongan" id="potongan" value="{{ $salary->potongan }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const employeeSelect = document.getElementById('karyawan_id');
        const gajiPokokInput = document.getElementById('gaji_pokok');

        employeeSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const gajiPokok = selectedOption.getAttribute('data-gajipokok');

            if (gajiPokok) {
                gajiPokokInput.value = gajiPokok;
            } else {
                gajiPokokInput.value = ''; 
            }
        });

        if (employeeSelect.value) {
            employeeSelect.dispatchEvent(new Event('change'));
        }
    });
</script>