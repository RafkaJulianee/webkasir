<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\User;

class DashboardController extends Controller
{
    // Menampilkan halaman utama dashboard dengan statistik ringkas
    public function index()
    {
        // Hitung total data masing-masing entitas untuk ditampilkan di kartu statistik
        $totalProduk = Produk::count();
        $totalKategori = Kategori::count();
        $totalUser = User::where('role_id', 2)->count(); // Hanya hitung user dengan role User

        return view('admin.dashboard.index', compact(
            'totalProduk',
            'totalKategori',
            'totalUser'
        ));
    }
}
