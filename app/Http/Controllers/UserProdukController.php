<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProdukController extends Controller
{
    // Menampilkan daftar produk untuk user dengan fitur pencarian dan pagination
    public function index(Request $request)
    {
        $query = \App\Models\Produk::with('kategori');

        // Filter produk berdasarkan nama jika ada input pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori
        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }

        $kategori = \App\Models\Kategori::all();

        // Tampilkan 5 produk per halaman dan pertahankan query pencarian pada URL pagination
        $produk = $query->paginate(5)->withQueryString();
        
        return view('user.produk.index', compact('produk', 'kategori'));
    }

    // Menampilkan detail spesifik dari sebuah produk
    public function show($id)
    {
        // Ambil data produk beserta kategorinya berdasarkan ID, atau tampilkan 404 jika tidak ditemukan
        $produk = \App\Models\Produk::with('kategori')->findOrFail($id);
        
        return view('user.produk.detail', compact('produk'));
    }
}
