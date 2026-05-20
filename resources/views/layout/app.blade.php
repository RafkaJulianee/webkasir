<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Kasir Modern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f6f8fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { width: 250px; min-height: 100vh; background: #fff; border-right: 1px solid #edf2f9; z-index: 1050; }
        .sidebar .nav-link { color: #5e6e82; font-weight: 500; padding: 10px 20px; border-radius: 8px; margin-bottom: 5px; }
        .sidebar .nav-link:hover { background-color: #f8f9fa; color: #2c7be5; }
        .sidebar .nav-link.active { background-color: #2c7be5; color: #fff; }
        .sidebar .nav-link i { margin-right: 10px; font-size: 1.1rem; }
        .topbar { background: transparent; padding: 20px 30px; }
        .search-input { background: #fff; border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.03); border-radius: 20px; padding-left: 45px; }
        .search-icon { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #a1aab2; z-index: 10; }
        .content-area { padding: 0 30px 30px 30px; }
        
        @media (min-width: 768px) {
            .sidebar { position: sticky; top: 0; }
        }

        @media (max-width: 767.98px) {
            .topbar { padding: 15px 20px; }
            .content-area { padding: 0 15px 15px 15px; }
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="offcanvas-md offcanvas-start sidebar d-flex flex-column py-4" tabindex="-1" id="sidebarMenu">
        <div class="px-4 mb-4 d-flex align-items-center justify-content-between">
            <div>
                <i class="bi bi-cart-fill fs-3 text-primary me-2"></i>
                <span class="fs-4 fw-bold" style="color: #1e2022;">MyKasir<span class="text-primary">.</span></span>
            </div>
            <button type="button" class="btn-close d-md-none" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"></button>
        </div>
        
        <ul class="nav flex-column mb-auto px-3">
            @if(Auth::user()->role_id == 1)
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="/admin/dashboard">
                        <i class="bi bi-grid-1x2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/produk*') ? 'active' : '' }}" href="/admin/produk">
                        <i class="bi bi-box-seam"></i> Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/kategori*') ? 'active' : '' }}" href="/admin/kategori">
                        <i class="bi bi-tags"></i> Kategori
                    </a>
                </li>
            @endif

            @if(Auth::user()->role_id == 2)
                <li class="nav-item">
                    <a class="nav-link active" href="/user/produk">
                        <i class="bi bi-box-seam"></i> Daftar Produk
                    </a>
                </li>
            @endif

            <li class="nav-item mt-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link text-danger border-0 w-100 text-start bg-transparent d-flex align-items-center">
                        <i class="bi bi-box-arrow-left text-danger"></i> Log out
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 d-flex flex-column" style="overflow-x: hidden;">
        <!-- Topbar -->
        <div class="topbar d-flex justify-content-between align-items-center gap-2">
            <div class="d-flex align-items-center flex-grow-1">
                <!-- Mobile Toggle Button -->
                <button class="btn btn-light d-md-none me-2 me-sm-3 border shadow-sm flex-shrink-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" style="border-radius: 10px;">
                    <i class="bi bi-list fs-5"></i>
                </button>
                
                <!-- Search (hidden on dashboard) -->
                @if(!request()->is('admin/dashboard'))
                <div class="position-relative flex-grow-1" style="max-width: 350px;">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" id="globalSearchInput" value="{{ request('search') }}" class="form-control form-control-lg search-input fs-6 py-2" placeholder="Search..." autocomplete="off">
                </div>
                @endif
            </div>
            
            <!-- Profile -->
            <div class="d-flex align-items-center flex-shrink-0">
                <div class="bg-secondary rounded-circle" style="width: 40px; height: 40px; overflow: hidden;">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=e0e7ff&color=4f46e5" alt="Avatar" class="w-100 h-100 object-fit-cover">
                </div>
                <div class="ms-2 d-none d-md-block">
                    <div class="fw-bold lh-1" style="font-size: 0.9rem;">{{ Auth::user()->name }}</div>
                    <div class="text-muted" style="font-size: 0.75rem;">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area flex-grow-1">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" style="border-radius: 10px;">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('globalSearchInput');
            
            // Cek apakah halaman ini memiliki tableContainer untuk di-update
            if (searchInput) {
                let debounceTimer;
                let abortController = null;

                searchInput.addEventListener('input', function() {
                    const query = this.value;
                    const tableContainer = document.getElementById('tableContainer');
                    
                    if (!tableContainer) return; // Jika tidak ada tabel, abaikan

                    // Bersihkan timer sebelumnya (Debounce)
                    clearTimeout(debounceTimer);
                    
                    // Batalkan request AJAX sebelumnya jika belum selesai (mencegah race condition)
                    if (abortController) {
                        abortController.abort();
                    }
                    
                    abortController = new AbortController();
                    const signal = abortController.signal;

                    // Tunggu 250ms setelah user selesai mengetik sebelum melakukan request
                    debounceTimer = setTimeout(() => {
                        const url = new URL(window.location.href);
                        url.searchParams.set('search', query);

                        fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            signal: signal
                        })
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newTable = doc.getElementById('tableContainer');
                            if (newTable) {
                                tableContainer.innerHTML = newTable.innerHTML;
                                // Perbarui URL di address bar tanpa reload halaman
                                window.history.replaceState({}, '', url);
                            }
                        })
                        .catch(error => {
                            // Abaikan error jika itu disebabkan oleh AbortController
                            if (error.name !== 'AbortError') {
                                console.error('Error fetching data:', error);
                            }
                        });
                    }, 250); 
                });
            }
        });
    </script>
</body>
</html>