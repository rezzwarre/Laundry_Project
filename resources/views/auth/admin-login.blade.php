@extends('layouts.app') 

@section('title', 'Login Admin')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card border-primary shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">LOGIN ADMINISTRATOR</h4>
            </div>
            <div class="card-body">
                
                {{-- ---------------------------------------------------- --}}
                {{-- 1. MENAMPILKAN PESAN ERROR OTENTIKASI (DARI CONTROLLER) --}}
                {{-- Jika AuthAdminController@login gagal, pesan ini akan muncul --}}
                @error('username')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal Login!</strong> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
                {{-- ---------------------------------------------------- --}}

                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    
                    {{-- FIELD USERNAME --}}
                    <div class="mb-3">
                        <label for="username" class="form-label">Username Admin</label>
                        <input 
                            type="text" 
                            class="form-control @error('username') is-invalid @enderror" 
                            id="username" 
                            name="username" 
                            value="{{ old('username') }}"
                            required 
                            autofocus
                        >
                        {{-- Pesan error jika field kosong (validasi 'required') --}}
                        @if ($errors->has('username') && $errors->first('username') !== 'Username atau password Admin tidak cocok.')
                            <div class="invalid-feedback">
                                {{ $errors->first('username') }}
                            </div>
                        @endif
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
                        {{-- Pesan error jika field kosong (validasi 'required') --}}
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection