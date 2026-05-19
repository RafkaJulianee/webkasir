<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan daftar kategori dengan fitur pencarian dan pagination
    public function index(Request $request)
    {
        $query = Kategori::query();

        if ($request->has('search')) {
            $query->where('nama_kategori', 'like', '%' . $request->search . '%');
        }

        // Gunakan pagination (5 data per halaman)
        $kategori = $query->paginate(5)->withQueryString();
        return view('kategori.index', compact('kategori'));
    }

    // Menampilkan form untuk menambahkan kategori baru
    public function create()
    {
        return view('kategori.create');
    }

    // Menyimpan data kategori baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        Kategori::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengubah data kategori
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    // Menyimpan perubahan data kategori ke database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    // Menghapus data kategori dari database
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}