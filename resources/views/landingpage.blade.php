@extends('layouts.head')

<body class="bg-light text-dark">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                LaundryKu
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto gap-lg-3">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#harga">Harga</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>

                
                @if (Route::has('login'))
                    <div class="d-flex gap-2">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary btn-sm">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">
                                Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="bg-primary text-white py-5" style="margin-top: 72px;">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-md-6">
                    <h1 class="fw-bold display-6 mb-4">
                        Solusi Laundry Bersih, Wangi & Cepat
                    </h1>
                    <p class="fs-5 mb-4">
                        Kami melayani laundry kiloan dan satuan dengan kualitas terbaik dan harga terjangkau.
                    </p>
                    <a href="#kontak" class="btn btn-light btn-lg text-primary fw-semibold">
                        Pesan Sekarang
                    </a>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('assets/images/laundry1.jpg') }}" class="img-fluid rounded shadow" alt="Laundry">
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan -->
    <section id="layanan" class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Layanan Kami</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow-sm h-100 text-center">
                        <div class="card-body">
                            <h5 class="fw-semibold">Laundry Kiloan</h5>
                            <p class="text-muted">Pilihan hemat untuk pakaian sehari-hari.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm h-100 text-center">
                        <div class="card-body">
                            <h5 class="fw-semibold">Laundry Satuan</h5>
                            <p class="text-muted">Perawatan khusus untuk pakaian premium.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm h-100 text-center">
                        <div class="card-body">
                            <h5 class="fw-semibold">Express</h5>
                            <p class="text-muted">Selesai cepat untuk kebutuhan mendesak.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Harga -->
    <section id="harga" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Daftar Harga</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card text-center shadow-sm h-100">
                        <div class="card-body">
                            <h5>Kiloan</h5>
                            <h2 class="text-primary fw-bold my-3">Rp7.000/kg</h2>
                            <p class="text-muted">3 Hari Selesai</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center shadow-sm h-100">
                        <div class="card-body">
                            <h5>Express</h5>
                            <h2 class="text-primary fw-bold my-3">Rp10.000/kg</h2>
                            <p class="text-muted">1 Hari Selesai</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center shadow-sm h-100">
                        <div class="card-body">
                            <h5>Satuan</h5>
                            <h2 class="text-primary fw-bold my-3">Mulai Rp5.000</h2>
                            <p class="text-muted">Per Item</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Hubungi Kami</h2>
            <p class="mb-4">
                Jl. Contoh No. 123, Kota Anda <br>
                WhatsApp: 08xxxxxxxxxx
            </p>
            <a href="#" class="btn btn-primary btn-lg">
                Chat WhatsApp
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-3">
        <p class="mb-0">&copy; 2025 LaundryKu. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>