@extends('layouts.admin')

@section('title', 'Dashboard Administrator')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h3>Ringkasan Aktivitas Sistem</h3>
            <p class="text-muted">Selamat datang kembali di Panel Administrasi Laundry App. Kelola data dan pantau performa layanan Anda di sini.</p>
        </div>
    </div>

    <!-- Statistik Utama (Card-Card Informasi) -->
    <div class="row">
        
        {{-- Card 1: Transaksi Hari Ini --}}
        <div class="col-md-4 mb-4">
            <div class="card border-start border-primary border-5 shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Transaksi Baru Hari Ini
                            </div>
                            {{-- Ganti angka 5 ini dengan data real dari Controller --}}
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $transaksiHariIni }}</div>
                        </div>
                        <div class="col-auto">
                            <!-- Icon untuk Transaksi -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="text-gray-300" viewBox="0 0 16 16">
                              <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm14 2.383-4.708 2.825L15 11.105zm-.035 6.883L10.708 9.07l-2.008 1.205 1.34 2.682-6.574-3.945-.494.321 7.021 4.195z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 2: Jenis Jasa Terdaftar --}}
        <div class="col-md-4 mb-4">
            <div class="card border-start border-success border-5 shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Jenis Jasa
                            </div>
                            {{-- Ganti angka 12 ini dengan data real dari Controller --}}
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalJasa }}</div>
                        </div>
                        <div class="col-auto">
                            <!-- Icon untuk Jasa -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="text-gray-300" viewBox="0 0 16 16">
                              <path d="M12.604 12c.07-.376.035-.742-.038-1.077-.195-.724-.58-1.554-1.265-2.284C9.563 7.85 8.358 7 6.786 7c-1.572 0-2.777.85-3.813 1.936-.685.73-1.07 1.56-1.265 2.284-.07.335-.106.701-.037 1.077h10.428zm-6.21-6.195c1.196 0 2.162-1.22 2.162-2.72S7.77 1.35 6.574 1.35c-1.197 0-2.163 1.22-2.163 2.72s.966 2.73 2.163 2.73z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 3: Pendapatan Bulan Ini --}}
        <div class="col-md-4 mb-4">
            <div class="card border-start border-warning border-5 shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Pendapatan Bulan Ini
                            </div>
                            {{-- Ganti angka 8500000 ini dengan data real dari Controller --}}
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <!-- Icon untuk Pendapatan/Uang -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="text-gray-300" viewBox="0 0 16 16">
                              <path d="M14 3H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1m-1 6H8.974C8.75 7.822 7.747 7 6.5 7c-1.5 0-2.5 1-2.5 2.5 0 1.5 1 2.5 2.5 2.5 1.247 0 2.25-1.052 2.726-2.5H13zm-6.5 2C5.597 11 5 10.403 5 9.5S5.597 8 6.5 8s1.5.597 1.5 1.5S7.403 11 6.5 11z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <!-- Navigasi Cepat dan Daftar Fitur -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-light">
                    <h5>Akses Cepat Fitur Admin</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Pengelolaan Transaksi
                        <a href="{{ route('admin.transaksi.index') }}" class="btn btn-sm btn-info text-white">Lihat Semua Transaksi</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Pengelolaan Jenis Jasa
                        <a href="{{ route('admin.jenis_jasa.index') }}" class="btn btn-sm btn-success">Kelola Jasa & Harga</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Laporan Keuangan
                        <a href="{{ route('admin.laporan.index') }}" class="btn btn-sm btn-warning">Buat Laporan</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Tambah Jasa Baru
                        <a href="{{ route('admin.jenis_jasa.create') }}" class="btn btn-sm btn-primary">Tambah Jasa</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection