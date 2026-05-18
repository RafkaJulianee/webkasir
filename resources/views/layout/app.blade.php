<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Kasir Sederhana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Kasir App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @if(Auth::user()->role_id == 1)
                        <li class="nav-item"><a class="nav-link" href="/admin/kategori">Kategori</a></li>
                        <li class="nav-item"><a class="nav-link" href="/admin/produk">Produk</a></li>
                    @endif

                    @if(Auth::user()->role_id == 2)
                        <li class="nav-item"><a class="nav-link" href="/user/produk">Daftar Produk</a></li>
                    @endif
                </ul>
                
                <form class="d-flex me-3" action="" method="GET">
                    <input class="form-control" type="search" name="search" id="globalSearchInput" placeholder="Ketik untuk mencari..." aria-label="Search" value="{{ request('search') }}" autocomplete="off">
                </form>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
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