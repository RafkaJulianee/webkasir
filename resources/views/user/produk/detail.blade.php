@extends('layout.app')

@section('content')
<div class="mb-4 d-flex align-items-center">
    <a href="{{ route('user.produk.index') }}" class="btn btn-light shadow-sm bg-white border rounded-3 py-2 px-3 me-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
    <h3 class="fw-bold mb-0" style="color: #1e2022;">Detail Produk</h3>
</div>

<div class="bg-white rounded-4 shadow-sm p-4">
    <div class="row">
        <div class="col-md-4 mb-4 mb-md-0">
            <div class="rounded-4 bg-light d-flex align-items-center justify-content-center overflow-hidden" style="aspect-ratio: 1; border: 1px dashed #cbd5e1;">
                @if($produk->gambar)
                    <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="w-100 h-100 object-fit-cover">
                @else
                    <div class="text-center text-muted">
                        <i class="bi bi-image" style="font-size: 3rem; color: #94a3b8;"></i>
                        <p class="mt-2 mb-0" style="font-size: 0.9rem;">Tidak ada gambar</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-8 ps-md-4">
            <h4 class="fw-bold mb-4" style="color: #1e2022; border-bottom: 2px solid #f1f5f9; padding-bottom: 15px;">{{ $produk->nama_produk }}</h4>
            
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th class="ps-0 py-2" style="width: 180px; color: #64748b;">Kategori</th>
                            <td class="py-2 fw-medium text-dark">: {{ $produk->kategori->nama_kategori ?? 'Tidak ada kategori' }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 py-2" style="color: #64748b;">Harga</th>
                            <td class="py-2 fw-bold" style="color: #059669; font-size: 1.15rem;">: Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 py-2" style="color: #64748b;">Stok</th>
                            <td class="py-2 fw-medium text-dark">: 
                                <span class="badge {{ $produk->stok > 0 ? 'bg-success' : 'bg-danger' }} rounded-pill px-3" style="font-size: 0.85rem;">
                                    {{ $produk->stok }} unit
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="ps-0 py-2 align-top" style="color: #64748b;">Dibuat Pada</th>
                            <td class="py-2 fw-medium text-muted">: {{ $produk->created_at ? $produk->created_at->format('d M Y H:i') : '-' }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 py-2 align-top" style="color: #64748b;">Terakhir Diperbarui</th>
                            <td class="py-2 fw-medium text-muted">: {{ $produk->updated_at ? $produk->updated_at->format('d M Y H:i') : '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
