<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Produk;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Data Role
        $roleAdmin = Role::create(['nama_role' => 'admin']);
        $roleUser = Role::create(['nama_role' => 'user']);

        // 2. Buat Data User dengan Password Terenkripsi
        User::create([
            'name' => 'Admin Toko',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'), // Password dienkripsi
            'role_id' => $roleAdmin->id,
        ]);

        User::create([
            'name' => 'Kasir Satu',
            'email' => 'kasir1@gmail.com',
            'password' => Hash::make('password123'), // Password dienkripsi
            'role_id' => $roleUser->id,
        ]);

        User::create([
            'name' => 'Kasir Dua',
            'email' => 'kasir2@gmail.com',
            'password' => Hash::make('password123'), // Password dienkripsi
            'role_id' => $roleUser->id,
        ]);

        // 3. Buat Data Kategori
        $katMakanan = Kategori::create(['nama_kategori' => 'Makanan']);
        $katMinuman = Kategori::create(['nama_kategori' => 'Minuman']);

        // 4. Buat 10 Data Produk
        Produk::insert([
            ['nama_produk' => 'Nasi Goreng Spesial', 'harga' => 25000, 'stok' => 50, 'kategori_id' => $katMakanan->id, 'created_at' => now(), 'updated_at' => now()],
            ['nama_produk' => 'Mie Goreng Seafood', 'harga' => 22000, 'stok' => 40, 'kategori_id' => $katMakanan->id, 'created_at' => now(), 'updated_at' => now()],
            ['nama_produk' => 'Ayam Bakar Madu', 'harga' => 30000, 'stok' => 30, 'kategori_id' => $katMakanan->id, 'created_at' => now(), 'updated_at' => now()],
            ['nama_produk' => 'Sate Ayam Madura', 'harga' => 20000, 'stok' => 25, 'kategori_id' => $katMakanan->id, 'created_at' => now(), 'updated_at' => now()],
            ['nama_produk' => 'Bakso Urat', 'harga' => 18000, 'stok' => 60, 'kategori_id' => $katMakanan->id, 'created_at' => now(), 'updated_at' => now()],
            ['nama_produk' => 'Es Teh Manis', 'harga' => 5000, 'stok' => 100, 'kategori_id' => $katMinuman->id, 'created_at' => now(), 'updated_at' => now()],
            ['nama_produk' => 'Es Jeruk Peras', 'harga' => 8000, 'stok' => 80, 'kategori_id' => $katMinuman->id, 'created_at' => now(), 'updated_at' => now()],
            ['nama_produk' => 'Kopi Susu Gula Aren', 'harga' => 15000, 'stok' => 50, 'kategori_id' => $katMinuman->id, 'created_at' => now(), 'updated_at' => now()],
            ['nama_produk' => 'Jus Mangga', 'harga' => 12000, 'stok' => 40, 'kategori_id' => $katMinuman->id, 'created_at' => now(), 'updated_at' => now()],
            ['nama_produk' => 'Air Mineral', 'harga' => 4000, 'stok' => 150, 'kategori_id' => $katMinuman->id, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}