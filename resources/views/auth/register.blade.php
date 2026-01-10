@extends('layouts.app')

@section('title', 'Registrasi User')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 85vh;">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow-lg border-0 rounded-4">

                {{-- HEADER --}}
                <div class="card-header bg-success text-white text-center py-4 rounded-top-4">
                    <h4 class="mb-0 fw-semibold">Daftar Pelanggan Baru</h4>
                    <small class="opacity-75">Lengkapi data untuk membuat akun</small>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- NAMA LENGKAP --}}
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                            <input
                                type="text"
                                class="form-control form-control-lg @error('nama') is-invalid @enderror"
                                id="nama"
                                name="nama"
                                value="{{ old('nama') }}"
                                placeholder="Masukkan nama lengkap"
                                required
                            >
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- USERNAME --}}
                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">Username</label>
                            <input
                                type="text"
                                class="form-control form-control-lg @error('username') is-invalid @enderror"
                                id="username"
                                name="username"
                                value="{{ old('username') }}"
                                placeholder="Buat username"
                                required
                            >
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- NO HP --}}
                        <div class="mb-3">
                            <label for="no_hp" class="form-label fw-semibold">No. HP</label>
                            <input
                                type="text"
                                class="form-control form-control-lg @error('no_hp') is-invalid @enderror"
                                id="no_hp"
                                name="no_hp"
                                value="{{ old('no_hp') }}"
                                placeholder="Contoh: 08xxxxxxxxxx"
                                required
                            >
                            @error('no_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- ALAMAT --}}
                        <div class="mb-3">
                            <label for="alamat" class="form-label fw-semibold">Alamat</label>
                            <textarea
                                class="form-control @error('alamat') is-invalid @enderror"
                                id="alamat"
                                name="alamat"
                                rows="3"
                                placeholder="Masukkan alamat lengkap"
                                required
                            >{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input
                                type="password"
                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                id="password"
                                name="password"
                                placeholder="Minimal 8 karakter"
                                required
                            >
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- KONFIRMASI PASSWORD --}}
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">
                                Konfirmasi Password
                            </label>
                            <input
                                type="password"
                                class="form-control form-control-lg"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Ulangi password"
                                required
                            >
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-success btn-lg">
                                Daftar
                            </button>
                        </div>

                        {{-- LINK LOGIN --}}
                        <div class="text-center">
                            <span class="text-muted">Sudah punya akun?</span>
                            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">
                                Login di sini
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
