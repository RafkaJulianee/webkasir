@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0" style="color: #1e2022;">Daftar Produk (Kasir)</h3>
    <div>
        <select id="kategoriFilter" class="form-select bg-white border shadow-sm fw-semibold px-3 py-2" style="border-radius: 10px; font-size: 0.9rem; min-width: 160px; cursor: pointer; color: #4a5568;">
            <option value="">Semua Kategori</option>
            @foreach($kategori as $kat)
                <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="bg-white rounded-4 shadow-sm p-2" id="tableContainer">
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0" style="color: #4a5568;">
            <thead>
                <tr style="border-bottom: 2px solid #f1f5f9; color: #a0aec0; font-size: 0.85rem;">
                    <th class="fw-semibold pb-3 ps-4">No</th>
                    <th class="fw-semibold pb-3">Gambar</th>
                    <th class="fw-semibold pb-3">Nama Produk</th>
                    <th class="fw-semibold pb-3">Kategori</th>
                    <th class="fw-semibold pb-3">Harga</th>
                    <th class="fw-semibold pb-3">Stok</th>
                    <th class="fw-semibold pb-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produk as $item)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td class="ps-4 py-3 text-muted fw-semibold">{{ ($produk->currentPage() - 1) * $produk->perPage() + $loop->iteration }}</td>
                    <td>
                        <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; overflow: hidden;">
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}" class="w-100 h-100 object-fit-cover">
                            @else
                                <span class="text-muted" style="font-size: 0.6rem;">No Img</span>
                            @endif
                        </div>
                    </td>
                    <td class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $item->nama_produk }}</td>
                    <td class="text-muted" style="font-size: 0.9rem;">{{ $item->kategori->nama_kategori ?? 'Tidak ada kategori' }}</td>
                    <td class="fw-semibold text-dark" style="font-size: 0.95rem;">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td class="text-muted" style="font-size: 0.9rem;">{{ $item->stok }}</td>
                    <td class="text-center">
                        <a href="{{ route('user.produk.show', $item->id) }}" class="btn btn-info btn-sm d-inline-flex align-items-center rounded-3 fw-medium" style="background-color: #e0f2fe; border-color: #e0f2fe; color: #0284c7;">
                            <i class="bi bi-eye me-1"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">Data produk tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="px-4 py-3">
        <x-pagination :data="$produk" />
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kategoriFilter = document.getElementById('kategoriFilter');
        if (kategoriFilter) {
            kategoriFilter.addEventListener('change', function() {
                const kategoriId = this.value;
                const url = new URL(window.location.href);
                if (kategoriId) {
                    url.searchParams.set('kategori_id', kategoriId);
                } else {
                    url.searchParams.delete('kategori_id');
                }
                
                const tableContainer = document.getElementById('tableContainer');
                if (tableContainer) {
                    fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newTable = doc.getElementById('tableContainer');
                        if (newTable) {
                            tableContainer.innerHTML = newTable.innerHTML;
                            window.history.replaceState({}, '', url);
                        }
                    })
                    .catch(error => {
                        console.error('Error filtering category:', error);
                    });
                }
            });
        }
    });
</script>
@endsection
