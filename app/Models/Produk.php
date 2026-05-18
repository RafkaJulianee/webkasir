<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel agar Laravel tidak otomatis mencari tabel 'produks'
    protected $table = 'produk';

    // Kolom yang diizinkan untuk diisi secara massal saat proses CRUD
    protected $fillable = [
        'nama_produk',
        'harga',
        'stok',
        'kategori_id',
        'gambar',
    ];

    /**
     * Relasi ke model Kategori
     * Produk -> belongsTo (Kategori)
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}