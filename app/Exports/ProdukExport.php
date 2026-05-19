<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProdukExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Produk::with('kategori')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Produk',
            'Kategori',
            'Harga',
            'Stok',
        ];
    }

    public function map($produk): array
    {
        return [
            $produk->id,
            $produk->nama_produk,
            $produk->kategori ? $produk->kategori->nama_kategori : 'Tidak ada kategori',
            $produk->harga,
            $produk->stok,
        ];
    }
}
