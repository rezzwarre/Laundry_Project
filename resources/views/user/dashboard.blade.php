{{-- @extends('layouts.app')

@section('title', 'Dashboard Pelanggan')

@section('content')
    <h2 class="mb-4">Selamat Datang, {{ Auth::user()->nama }}!</h2>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card text-center bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Buat Transaksi Baru</h5>
                    <p class="card-text">Pesan layanan laundry Anda sekarang.</p>
                    <a href="{{ route('user.transaksi.create') }}" class="btn btn-light">Buat Pesanan</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Lihat Riwayat Transaksi</h5>
                    <p class="card-text">Cek status dan riwayat pesanan Anda.</p>
                    <a href="{{ route('user.transaksi.index') }}" class="btn btn-light">Lihat Riwayat</a>
                </div>
            </div>
        </div>
    </div>
@endsection --}}


@extends('layouts.app')

@section('title', 'Dashboard Pelanggan')

@section('content')
    <h2 class="mb-4">Selamat Datang, {{ Auth::user()->nama }}!</h2>
    
    <!-- Bagian Informasi Profil Singkat -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            Informasi Akun Anda
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Username:</strong> {{ Auth::user()->username }}</p>
                    <p><strong>Nama Lengkap:</strong> {{ Auth::user()->nama }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>No. HP:</strong> {{ Auth::user()->no_hp }}</p>
                    <p><strong>Alamat:</strong> {{ Auth::user()->alamat }}</p>
                </div>
            </div>
            <a href="{{ route('user.profile.update') }}" class="btn btn-sm btn-outline-primary mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-1" viewBox="0 0 16 16">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.639a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.121l6.813-6.814z"/>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                </svg>
                Update Profil Saya
            </a>
        </div>
    </div>
    
    <!-- Bagian Akses Cepat (Transaksi) -->
    <div class="row">
        
        {{-- Card 1: Buat Transaksi Baru --}}
        <div class="col-md-6 mb-4">
            <div class="card text-center bg-info text-white h-100 shadow">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Buat Pesanan Baru</h5>
                    <p class="card-text">Pesan layanan laundry Anda sekarang.</p>
                    <a href="{{ route('user.transaksi.create') }}" class="btn btn-light mt-auto">Buat Pesanan</a>
                </div>
            </div>
        </div>
        
        {{-- Card 2: Riwayat Transaksi --}}
        <div class="col-md-6 mb-4">
            <div class="card text-center bg-success text-white h-100 shadow">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Lihat Riwayat Transaksi</h5>
                    <p class="card-text">Cek status dan riwayat pesanan Anda.</p>
                    <a href="{{ route('user.transaksi.index') }}" class="btn btn-light mt-auto">Lihat Riwayat</a>
                </div>
            </div>
        </div>
        
    </div>
@endsection