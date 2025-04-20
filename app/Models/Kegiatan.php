<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kegiatan extends Model
{
    protected static function booted()
    {
        // Hook ketika kegiatan dihapus
        static::deleted(function ($kegiatan) {
            // Menghapus gambar yang terkait dengan kegiatan setelah dihapus
            if ($kegiatan->banner_image) {
                Storage::disk('public')->delete($kegiatan->banner_image);
            }
        });
    }
    use HasFactory;

    // Menambahkan kolom yang ingin diisi secara massal
    protected $fillable = [
        'nama_kegiatan',    // Nama kegiatan
        'deskripsi',        // Deskripsi kegiatan
        'lokasi',           // Lokasi kegiatan
        'waktu',            // Waktu kegiatan
        'hari',             // Hari kegiatan
        'banner_image',     // Banner gambar yang di-upload
    ];

    // Menentukan nama primary key yang digunakan
    protected $primaryKey = 'id_kegiatan';  // Jika primary key Anda adalah 'id_kegiatan'
}
