<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traits\Searchable;

class Department extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'nama_departemen',
    ];

    protected $searchable = [
        'nama_departemen'
    ];

    public function employees()
    {
        // Kita perlu menyertakan 'departemen_id' sebagai argumen kedua
        // karena nama kolom Anda tidak mengikuti konvensi 'department_id' (English).
        return $this->hasMany(Employee::class, 'departemen_id');
    }
    
    public function salaries()
    {
        return $this->hasManyThrough(
            Salary::class,    // Model akhir yang ingin kita akses
            Employee::class,  // Model perantara
            'departemen_id',  // Foreign key di tabel perantara (employees)
            'karyawan_id',    // Foreign key di tabel akhir (salaries)
            'id',             // Local key di tabel awal (departments)
            'id'              // Local key di tabel perantara (employees)
        );
    }
}
