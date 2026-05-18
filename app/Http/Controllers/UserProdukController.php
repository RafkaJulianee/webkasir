<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Produk::with('kategori');

        if ($request->has('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        $produk = $query->paginate(10)->withQueryString();
        return view('user.produk.index', compact('produk'));
    }
}
