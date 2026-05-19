<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProdukExport;

class ProdukController extends Controller
{
    // Mengekspor data produk ke dalam format PDF
    public function exportPdf()
    {
        $produk = Produk::with('kategori')->get();
        $pdf = Pdf::loadView('produk.pdf', compact('produk'));
        
        return $pdf->download('Data_Produk_' . now()->timezone('Asia/Jakarta')->format('Y-m-d_H-i-s') . '.pdf');
    }

    // Mengekspor data produk ke dalam format Excel
    public function exportExcel()
    {
        return Excel::download(new ProdukExport, 'Data_Produk_' . now()->timezone('Asia/Jakarta')->format('Y-m-d_H-i-s') . '.xlsx');
    }
    // Menampilkan daftar produk untuk admin dengan fitur pencarian dan pagination
    public function index(Request $request)
    {
        $query = Produk::with('kategori');

        // Filter pencarian berdasarkan nama produk
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori
        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }

        $kategori = Kategori::all();

        // Ambil 5 data per halaman dan pertahankan query parameter
        $produk = $query->paginate(5)->withQueryString();
        return view('produk.index', compact('produk', 'kategori'));
    }

    // Menampilkan detail produk
    public function show($id)
    {
        $produk = Produk::with('kategori')->findOrFail($id);
        return view('produk.detail', compact('produk'));
    }

    // Menampilkan form untuk menambahkan produk baru
    public function create()
    {
        // Ambil data kategori untuk ditampilkan sebagai opsi dropdown
        $kategori = Kategori::all();
        return view('produk.create', compact('kategori'));
    }

    // Menyimpan data produk baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Proses unggah gambar jika ada
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengubah data produk
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all(); // Data kategori untuk dropdown
        return view('produk.edit', compact('produk', 'kategori'));
    }

    // Menyimpan perubahan data produk ke dalam database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $produk = Produk::findOrFail($id);
        $data = $request->all();

        // Proses unggah gambar baru dan penghapusan gambar lama jika ada
        if ($request->hasFile('gambar')) {
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // Menghapus data produk dari database beserta gambarnya
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus file gambar dari server jika ada
        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}