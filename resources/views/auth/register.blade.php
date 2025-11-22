@extends('layouts.app')

@section('title', 'Registrasi User')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Daftar Pelanggan Baru</div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- NAMA LENGKAP --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input 
                            type="text" 
                            class="form-control @error('nama') is-invalid @enderror" 
                            id="nama" 
                            name="nama" 
                            value="{{ old('nama') }}" 
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
                        <label for="username" class="form-label">Username</label>
                        <input 
                            type="text" 
                            class="form-control @error('username') is-invalid @enderror" 
                            id="username" 
                            name="username" 
                            value="{{ old('username') }}" 
                            required
                        >
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- NO. HP --}}
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No. HP</label>
                        <input 
                            type="text" 
                            class="form-control @error('no_hp') is-invalid @enderror" 
                            id="no_hp" 
                            name="no_hp" 
                            value="{{ old('no_hp') }}" 
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
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea 
                            class="form-control @error('alamat') is-invalid @enderror" 
                            id="alamat" 
                            name="alamat" 
                            rows="3" 
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

                    {{-- KONFIRMASI PASSWORD --}}
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input 
                            type="password" 
                            class="form-control @error('password_confirmation') is-invalid @enderror" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            required
                        >
                        {{-- Catatan: Error 'confirmed' pada password akan ditampilkan di field 'password' --}}
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-success">Daftar</button>
                    <a href="{{ route('login') }}" class="btn btn-link">Sudah punya akun? Login</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection