<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftar extends Model
{
    use HasFactory;

    // Menambahkan kolom yang boleh diisi secara massal
    protected $fillable = [
        'name', 
        'phone_number', 
        'alamat', 
        'kategori_olahraga', 
        'status',
    ];
}
