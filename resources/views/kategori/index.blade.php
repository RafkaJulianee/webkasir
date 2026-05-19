@extends('layout.app')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <h3 class="fw-bold mb-0" style="color: #1e2022;">Kategori</h3>
    <div class="d-flex flex-wrap align-items-center gap-2">
        <a href="{{ route('kategori.create') }}" class="btn btn-primary fw-semibold px-4 py-2" style="border-radius: 10px; font-size: 0.9rem; background-color: #2c7be5; border-color: #2c7be5;">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
        </a>
    </div>
</div>

<div class="bg-white rounded-4 shadow-sm p-2" id="tableContainer">
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0" style="color: #4a5568;">
            <thead>
                <tr style="border-bottom: 2px solid #f1f5f9; color: #a0aec0; font-size: 0.85rem;">
                    <th class="fw-semibold pb-3 ps-4" style="width: 80px;">No</th>
                    <th class="fw-semibold pb-3">Nama Kategori</th>
                    <th class="fw-semibold pb-3 text-center" style="width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategori as $item)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td class="ps-4 py-3 text-muted fw-semibold">{{ ($kategori->currentPage() - 1) * $kategori->perPage() + $loop->iteration }}</td>
                    <td class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $item->nama_kategori }}</td>
                    <td class="text-center py-3">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-warning btn-sm d-flex align-items-center rounded-3 fw-medium" style="background-color: #fef08a; border-color: #fef08a; color: #854d0e;">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </a>
                            <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                    <td colspan="3" class="text-center py-5 text-muted">Data kategori tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-4 py-3">
        <x-pagination :data="$kategori" />
    </div>
</div>
@endsection