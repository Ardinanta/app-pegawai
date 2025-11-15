<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traits\Searchable;

class Position extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'nama_jabatan',
        'gaji_pokok',
    ];

    protected $searchable = [
        'nama_jabatan',
        'gaji_pokok'
    ];
}
