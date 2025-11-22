@extends('layouts.app')

@section('title', 'Login User')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">Login Pelanggan</div>
            <div class="card-body">

                {{-- ---------------------------------------------------------------- --}}
                {{-- 1. MENAMPILKAN PESAN ERROR OTENTIKASI (Dari Auth::attempt yang gagal) --}}
                {{-- Controller mengembalikan pesan error dengan key 'username' --}}
                @if ($errors->has('username'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Login Gagal!</strong> {{ $errors->first('username') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                {{-- ---------------------------------------------------------------- --}}

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- FIELD USERNAME --}}
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input 
                            type="text" 
                            {{-- Tambahkan kelas is-invalid jika ada error validasi bawaan --}}
                            class="form-control @error('username') is-invalid @enderror" 
                            id="username" 
                            name="username" 
                            value="{{ old('username') }}" 
                            required 
                            autofocus
                        >
                        {{-- Menampilkan pesan error validasi (misalnya: 'The username field is required.') --}}
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- FIELD PASSWORD --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            id="password" 
                            name="password" 
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="{{ route('register') }}" class="btn btn-link">Belum punya akun? Daftar</a>
                    <a href="{{ route('admin.login') }}" class="btn btn-link">Login Admin</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection