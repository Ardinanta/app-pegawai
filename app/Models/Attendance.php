<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Searchable;

class Attendance extends Model
{
    use HasFactory, Searchable;
    
    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'waktu_masuk',
        'waktu_keluar',
        'status_absensi',
    ];

    protected $searchable = [
        'status_absensi',
        'tanggal'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'karyawan_id');
    }
}
