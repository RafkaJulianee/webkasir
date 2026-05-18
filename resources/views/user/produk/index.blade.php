@extends('layout.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Daftar Produk (Kasir)</h5>
    </div>
    <div class="card-body">
        <div id="tableContainer">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produk as $item)
                        <tr>
                            <td>{{ ($produk->currentPage() - 1) * $produk->perPage() + $loop->iteration }}</td>
                            <td>
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}" class="img-thumbnail" style="max-width: 60px; max-height: 60px;">
                                @else
                                    <span class="badge bg-secondary">No Image</span>
                                @endif
                            </td>
                            <td>{{ $item->nama_produk }}</td>
                            <td>{{ $item->kategori->nama_kategori ?? 'Tidak ada kategori' }}</td>
                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ $item->stok }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Data produk tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Menampilkan Komponen Pagination -->
            <x-pagination :data="$produk" />
        </div>
    </div>
</div>
@endsection
