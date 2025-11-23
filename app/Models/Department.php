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
        return $this->hasMany(Employee::class, 'departemen_id');
    }
    
    public function salaries()
    {
        return $this->hasManyThrough(
            Salary::class,   
            Employee::class,  
            'departemen_id',  
            'karyawan_id',    
            'id',             
            'id'              
        );
    }
}
