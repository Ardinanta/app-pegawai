<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Searchable;

class Salary extends Model
{
    use HasFactory, Searchable;
    
    protected $fillable = [
        'karyawan_id',
        'bulan',
        'gaji_pokok',
        'tunjangan',
        'potongan',
        'total_gaji',
    ];

    protected $searchable = [
        'bulan',
        'gaji_pokok'
    ];

    protected $searchableRelations = [
        'employee' => ['nama_lengkap'] 
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'karyawan_id');
    }
}
