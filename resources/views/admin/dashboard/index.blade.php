@extends('layout.app')

@section('content')
<!-- Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
    <div>
        <h3 class="fw-bold mb-1" style="color: #1e2022;">Dashboard</h3>
        <p class="text-muted mb-0" style="font-size: 0.9rem;">Selamat datang kembali, <span class="fw-semibold text-dark">{{ Auth::user()->name }}</span></p>
    </div>
    <div class="text-muted" style="font-size: 0.85rem;">
        <i class="bi bi-calendar3 me-1"></i> {{ now()->timezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, D MMMM Y') }}
    </div>
</div>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <!-- Total Produk -->
    <div class="col-md-4">
        <div class="bg-white rounded-4 shadow-sm p-4 h-100" style="border-left: 4px solid #2c7be5;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1 fw-medium" style="font-size: 0.85rem;">Total Produk</p>
                    <h2 class="fw-bold mb-0" style="color: #1e2022;">{{ $totalProduk }}</h2>
                </div>
                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: rgba(44,123,229,0.1);">
                    <i class="bi bi-box-seam fs-4" style="color: #2c7be5;"></i>
                </div>
            </div>
            <a href="{{ route('produk.index') }}" class="text-decoration-none d-inline-flex align-items-center mt-3" style="font-size: 0.8rem; color: #2c7be5;">
                Kelola Produk <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>

    <!-- Total Kategori -->
    <div class="col-md-4">
        <div class="bg-white rounded-4 shadow-sm p-4 h-100" style="border-left: 4px solid #00d97e;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1 fw-medium" style="font-size: 0.85rem;">Total Kategori</p>
                    <h2 class="fw-bold mb-0" style="color: #1e2022;">{{ $totalKategori }}</h2>
                </div>
                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: rgba(0,217,126,0.1);">
                    <i class="bi bi-tags fs-4" style="color: #00d97e;"></i>
                </div>
            </div>
            <a href="{{ route('kategori.index') }}" class="text-decoration-none d-inline-flex align-items-center mt-3" style="font-size: 0.8rem; color: #00d97e;">
                Kelola Kategori <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>

    <!-- Total User Aktif -->
    <div class="col-md-4">
        <div class="bg-white rounded-4 shadow-sm p-4 h-100" style="border-left: 4px solid #f6c343;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1 fw-medium" style="font-size: 0.85rem;">Total User Aktif</p>
                    <h2 class="fw-bold mb-0" style="color: #1e2022;">{{ $totalUser }}</h2>
                </div>
                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: rgba(246,195,67,0.12);">
                    <i class="bi bi-people fs-4" style="color: #f6c343;"></i>
                </div>
            </div>
            <span class="text-muted d-inline-block mt-3" style="font-size: 0.8rem;">
                <i class="bi bi-check-circle-fill text-success me-1" style="font-size: 0.75rem;"></i> Semua user aktif
            </span>
        </div>
    </div>
</div>

<!-- Quick Access -->
<div class="row g-3">
    <div class="col-12">
        <div class="bg-white rounded-4 shadow-sm p-4">
            <h6 class="fw-bold mb-3" style="color: #1e2022;">Akses Cepat</h6>
            <div class="row g-3">
                <div class="col-md-3 col-6">
                    <a href="{{ route('produk.create') }}" class="text-decoration-none">
                        <div class="border rounded-3 p-3 text-center h-100 quick-link">
                            <div class="rounded-3 d-inline-flex align-items-center justify-content-center mb-2" style="width: 42px; height: 42px; background-color: rgba(44,123,229,0.1);">
                                <i class="bi bi-plus-lg" style="color: #2c7be5; font-size: 1.1rem;"></i>
                            </div>
                            <p class="mb-0 fw-semibold small" style="color: #1e2022;">Tambah Produk</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="{{ route('produk.index') }}" class="text-decoration-none">
                        <div class="border rounded-3 p-3 text-center h-100 quick-link">
                            <div class="rounded-3 d-inline-flex align-items-center justify-content-center mb-2" style="width: 42px; height: 42px; background-color: rgba(44,123,229,0.1);">
                                <i class="bi bi-box-seam" style="color: #2c7be5; font-size: 1.1rem;"></i>
                            </div>
                            <p class="mb-0 fw-semibold small" style="color: #1e2022;">Daftar Produk</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="{{ route('kategori.index') }}" class="text-decoration-none">
                        <div class="border rounded-3 p-3 text-center h-100 quick-link">
                            <div class="rounded-3 d-inline-flex align-items-center justify-content-center mb-2" style="width: 42px; height: 42px; background-color: rgba(0,217,126,0.1);">
                                <i class="bi bi-tags" style="color: #00d97e; font-size: 1.1rem;"></i>
                            </div>
                            <p class="mb-0 fw-semibold small" style="color: #1e2022;">Daftar Kategori</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="{{ route('produk.export-pdf') }}" target="_blank" class="text-decoration-none">
                        <div class="border rounded-3 p-3 text-center h-100 quick-link">
                            <div class="rounded-3 d-inline-flex align-items-center justify-content-center mb-2" style="width: 42px; height: 42px; background-color: rgba(220,53,69,0.1);">
                                <i class="bi bi-file-earmark-pdf" style="color: #dc3545; font-size: 1.1rem;"></i>
                            </div>
                            <p class="mb-0 fw-semibold small" style="color: #1e2022;">Export PDF</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .quick-link {
        transition: all 0.2s ease;
        border-color: #edf2f9 !important;
    }
    .quick-link:hover {
        background-color: #f8f9fa;
        border-color: #2c7be5 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
</style>
@endsection
