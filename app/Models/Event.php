<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    protected static function booted()
    {
        // Hook ketika event dihapus
        static::deleted(function ($event) {
            // Menghapus gambar yang terkait dengan event setelah dihapus
            if ($event->banner_image) {
                Storage::disk('public')->delete($event->banner_image);
            }
        });
    }
    use HasFactory;

    // Menambahkan kolom yang ingin diisi secara massal
    protected $fillable = [
        'nama_event',
        'deskripsi',
        'lokasi',
        'waktu',
        'hari',
        'tanggal_mulai',
        'tanggal_selesai',   // Menambahkan tanggal_selesai ke dalam fillable
        'banner_image',
    ];

    // Menentukan nama primary key yang digunakan
    protected $primaryKey = 'id_event';  // Jika primary key Anda adalah 'id_event'
}
