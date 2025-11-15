<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Searchable;

class Employee extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'departemen_id',
        'jabatan_id',
        'status',
    ];

    protected $searchable = [
        'nama_lengkap',
        'email'
    ];

    protected $searchableRelations = [
        'department' => ['nama_departemen'],
        'position'   => ['nama_jabatan']
    ];

    public function department() 
    {
        return $this->belongsTo(Department::class, 'departemen_id');
    }

    public function position() 
    {
        return $this->belongsTo(Position::class, 'jabatan_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'karyawan_id');
    }
}
