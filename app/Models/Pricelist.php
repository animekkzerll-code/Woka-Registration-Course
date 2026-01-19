<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricelist extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_paket',
        'jenis',
        'durasi',
        'harga',
        'features',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
    ];
}
