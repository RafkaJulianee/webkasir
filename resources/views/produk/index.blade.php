@extends('layout.app')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <h3 class="fw-bold mb-0" style="color: #1e2022;">Produk</h3>
    <div class="d-flex flex-wrap align-items-center gap-2">
        <div class="me-2">
            <select id="kategoriFilter" class="form-select bg-white border shadow-sm fw-semibold px-3 py-2" style="border-radius: 10px; font-size: 0.9rem; min-width: 160px; cursor: pointer; color: #4a5568;">
                <option value="">Semua Kategori</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="dropdown me-3">
            <button class="btn btn-light bg-white border shadow-sm fw-semibold px-3 py-2 dropdown-toggle" type="button" data-bs-toggle="dropdown" style="border-radius: 10px; font-size: 0.9rem;">
                <i class="bi bi-upload"></i> Export
            </button>
            <ul class="dropdown-menu shadow-sm border-0">
                <li><a class="dropdown-item text-danger fw-semibold" href="{{ route('produk.export-pdf') }}" target="_blank"><i class="bi bi-file-pdf me-2"></i>Export PDF</a></li>
                <li><a class="dropdown-item text-success fw-semibold" href="{{ route('produk.export-excel') }}" target="_blank"><i class="bi bi-file-excel me-2"></i>Export Excel</a></li>
            </ul>
        </div>
        <a href="{{ route('produk.create') }}" class="btn btn-primary fw-semibold px-4 py-2" style="border-radius: 10px; font-size: 0.9rem; background-color: #2c7be5; border-color: #2c7be5;">
            <i class="bi bi-plus-lg me-1"></i> Tambah Produk 
        </a>
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
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('produk.show', $item->id) }}" class="btn btn-info btn-sm d-flex align-items-center rounded-3 fw-medium" style="background-color: #e0f2fe; border-color: #e0f2fe; color: #0284c7;">
                                <i class="bi bi-eye me-1"></i> Detail
                            </a>
                            <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-warning btn-sm d-flex align-items-center rounded-3 fw-medium" style="background-color: #fef08a; border-color: #fef08a; color: #854d0e;">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </a>
                            <form action="{{ route('produk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center rounded-3 fw-medium" style="background-color: #fee2e2; border-color: #fee2e2; color: #dc2626;">
                                    <i class="bi bi-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
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