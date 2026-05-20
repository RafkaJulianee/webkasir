<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel sesuai dengan rancangan database
    protected $table = 'kategori';

    // Kolom yang dizinkan untuk diisi secara massal
    protected $fillable = [
        'nama_kategori',
    ];

    
    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}