<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Slip Gaji - {{ $salary->employee->nama_lengkap }} - {{ $salary->bulan }}</title>

    <style>
        body { font-family: sans-serif; margin: 0; }
        .container { padding: 20px; }
        .header { text-align: center; border-bottom: 1px solid #ddd; padding-bottom: 10px; }
        .header h1 { margin: 0; }
        .header p { margin: 5px 0 0; }
        .content { margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .details { width: 50%; float: left; }
        .summary { width: 45%; float: right; }
        .clearfix::after { content: ""; clear: both; display: table; }
        .total { font-weight: bold; font-size: 1.1em; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Slip Gaji</h1>
            <p>Periode: {{ \Carbon\Carbon::parse($salary->bulan)->format('F Y') }}</p>
        </div>

        <div class="content clearfix">
            <div class="details">
                <table>
                    <tr>
                        <th>Nama Karyawan</th>
                        <td>{{ $salary->employee->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>{{ $salary->employee->position->nama_jabatan }}</td>
                    </tr>
                    <tr>
                        <th>Departemen</th>
                        <td>{{ $salary->employee->department->nama_departemen }}</td>
                    </tr>
                </table>
            </div>

            <div class="summary">
                <table>
                    <tr>
                        <th>Gaji Pokok</th>
                        <td>Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Tunjangan</th>
                        <td>Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Potongan</th>
                        <td>(Rp {{ number_format($salary->potongan, 0, ',', '.') }})</td>
                    </tr>
                    <tr class="total">
                        <th>Total Gaji</th>
                        <td>Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>