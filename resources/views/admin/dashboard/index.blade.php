@extends('layout.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h4 class="mb-3">Dashboard Statistik</h4>
    </div>

    <!-- Total Produk -->
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-0 border-start border-primary border-4 h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted fw-normal mb-1">Total Produk</h6>
                        <h3 class="mb-0 fw-bold">{{ $totalProduk }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0">
                <a href="{{ route('produk.index') }}" class="text-decoration-none text-primary small fw-semibold">Kelola Produk &rarr;</a>
            </div>
        </div>
    </div>

    <!-- Total Kategori -->
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-0 border-start border-success border-4 h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted fw-normal mb-1">Total Kategori</h6>
                        <h3 class="mb-0 fw-bold">{{ $totalKategori }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-success"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0">
                <a href="{{ route('kategori.index') }}" class="text-decoration-none text-success small fw-semibold">Kelola Kategori &rarr;</a>
            </div>
        </div>
    </div>

    <!-- Total Kasir -->
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-0 border-start border-warning border-4 h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted fw-normal mb-1">Total Kasir Aktif</h6>
                        <h3 class="mb-0 fw-bold">{{ $totalKasir }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-warning"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
