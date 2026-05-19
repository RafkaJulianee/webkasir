<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MyKasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-white overflow-hidden" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

<div class="container-fluid p-0">
    <div class="row g-0 min-vh-100">
        
        <!-- Left Panel (Blue Background) -->
        <div class="col-lg-7 d-none d-lg-flex position-relative overflow-hidden p-5 flex-column justify-content-center text-white" 
             style="background: linear-gradient(145deg, #2b39d1 0%, #1e29a8 100%);">
             
            <!-- Background Lines -->
            <div class="position-absolute" 
                 style="top: -20%; left: -10%; width: 120%; height: 120%; z-index: 1; 
                 background-image: radial-gradient(circle at top left, transparent 20%, rgba(255,255,255,0.03) 21%, transparent 22%),
                                   radial-gradient(circle at top left, transparent 35%, rgba(255,255,255,0.05) 36%, transparent 37%),
                                   radial-gradient(circle at top left, transparent 50%, rgba(255,255,255,0.03) 51%, transparent 52%),
                                   radial-gradient(circle at top left, transparent 65%, rgba(255,255,255,0.05) 66%, transparent 67%);">
            </div>
            
            <div class="position-relative z-2 ms-5">
                <div class="display-1 lh-1 mb-4 fw-light">❋</div>
                <div class="fw-bold mb-4" style="font-size: 4.5rem; line-height: 1.1; letter-spacing: -1px;">
                    Welcome To<br>MyKasir! 
                    <span class="d-inline-block" style="animation: wave 2s infinite; transform-origin: 70% 70%;">👋</span>
                </div>
                <p class="fs-5 opacity-75" style="max-width: 450px; line-height: 1.6;">
                    Kelola data produk dan penjualan Anda dengan lebih cepat. Tingkatkan produktivitas bisnis dan hemat banyak waktu setiap harinya!
                </p>
            </div>
            
            <div class="position-absolute bottom-0 start-0 m-5 ms-5 ps-3 opacity-50 small z-2">
                &copy; {{ date('Y') }} MyKasir. All rights reserved.
            </div>
        </div>

        <!-- Right Panel (Form) -->
        <div class="col-12 col-lg-5 d-flex flex-column p-4 p-lg-5 position-relative">
            <div class="fs-3 fw-bolder text-dark mb-5 text-center text-lg-start" style="letter-spacing: -0.5px;">MyKasir.</div>
            
            <div class="d-flex flex-column justify-content-center flex-grow-1 mx-auto w-100" style="max-width: 400px;">
                <div>
                    <h2 class="fw-bold text-dark mb-2" style="font-size: 2rem; letter-spacing: -0.5px;">Selamat Datang Kembali!</h2>
                    

                    @if($errors->any())
                        <div class="alert alert-danger py-2 px-3 rounded-2 small">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-4">
                            <input type="email" 
                                   class="form-control border-0 border-bottom border-2 rounded-0 px-2 py-2 shadow-none" 
                                   style="background-color: transparent;" 
                                   id="email" name="email" value="{{ old('email') }}" 
                                   placeholder="Email Address" required autofocus autocomplete="off"
                                   onfocus="this.style.borderColor='#111'; this.style.backgroundColor='#f8f9fa';"
                                   onblur="this.style.borderColor='#dee2e6'; this.style.backgroundColor='transparent';">
                        </div>
                        
                        <div class="mb-5">
                            <input type="password" 
                                   class="form-control border-0 border-bottom border-2 rounded-0 px-2 py-2 shadow-none" 
                                   style="background-color: transparent;" 
                                   id="password" name="password" placeholder="Password" required
                                   onfocus="this.style.borderColor='#111'; this.style.backgroundColor='#f8f9fa';"
                                   onblur="this.style.borderColor='#dee2e6'; this.style.backgroundColor='transparent';">
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" style="border-radius: 8px;">
                            Login 
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>

<!-- Animasi Waving Hand tetap memerlukan sedikit CSS internal (atau dapat dihapus jika tidak perlu) -->
<style>
    @keyframes wave {
        0% { transform: rotate( 0.0deg) }
        10% { transform: rotate(14.0deg) }  
        20% { transform: rotate(-8.0deg) }
        30% { transform: rotate(14.0deg) }
        40% { transform: rotate(-4.0deg) }
        50% { transform: rotate(10.0deg) }
        60% { transform: rotate( 0.0deg) }  
        100% { transform: rotate( 0.0deg) }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>