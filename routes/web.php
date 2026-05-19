<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

// Import Controller Baru
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserProdukController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role_id == 1) {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/user/produk');
        }
    }
    return redirect('/login');
});

// Route Authentication
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk Admin (role_id = 1)
Route::middleware(['auth', 'role:1'])->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('kategori', KategoriController::class);
    
    // Rute Export
    Route::get('produk/export-pdf', [ProdukController::class, 'exportPdf'])->name('produk.export-pdf');
    Route::get('produk/export-excel', [ProdukController::class, 'exportExcel'])->name('produk.export-excel');
    
    Route::resource('produk', ProdukController::class); 
});

// Rute untuk User/Kasir (role_id = 2)
Route::middleware(['auth', 'role:2'])->prefix('user')->group(function () {
    Route::get('produk', [UserProdukController::class, 'index'])->name('user.produk.index');
    Route::get('produk/{id}', [UserProdukController::class, 'show'])->name('user.produk.show');
});