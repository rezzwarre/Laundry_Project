@extends('layouts.app')

@section('title', 'Login User')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4">
                
                {{-- HEADER --}}
                <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                    <h4 class="mb-0 fw-semibold">Login Pelanggan</h4>
                    <small class="opacity-75">Silakan masuk ke akun Anda</small>
                </div>

                <div class="card-body p-4">

                    {{-- PESAN ERROR LOGIN --}}
                    @if ($errors->has('username'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Login gagal!</strong> {{ $errors->first('username') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- USERNAME --}}
                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">Username</label>
                            <input 
                                type="text"
                                class="form-control form-control-lg @error('username') is-invalid @enderror"
                                id="username"
                                name="username"
                                value="{{ old('username') }}"
                                placeholder="Masukkan username"
                                required
                                autofocus
                            >
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input 
                                type="password"
                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                id="password"
                                name="password"
                                placeholder="Masukkan password"
                                required
                            >
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- BUTTON LOGIN --}}
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Login
                            </button>
                        </div>

                        {{-- LINK TAMBAHAN --}}
                        <div class="text-center">
                            <a href="{{ route('register') }}" class="text-decoration-none">
                                Belum punya akun?
                            </a>
                            <span class="mx-2">|</span>
                            <a href="{{ route('admin.login') }}" class="text-decoration-none text-danger">
                                Login Admin
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
