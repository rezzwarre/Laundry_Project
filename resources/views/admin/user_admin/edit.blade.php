@extends('layouts.admin')

@section('title', 'Edit Admin')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Perbarui Data Admin</h4>
            </div>
            <div class="card-body">
                
                {{-- Notifikasi Sukses --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- FORM UPDATE DATA --}}
                <form method="POST" action="{{ route('admin.user_admin.update') }}">
                    @csrf
                    {{-- Laravel menggunakan method PUT untuk operasi update --}}
                    @method('PUT') 

                    {{-- USERNAME --}}
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input 
                            type="text" 
                            class="form-control @error('username') is-invalid @enderror" 
                            id="username" 
                            name="username" 
                            value="{{ old('username', $user->username) }}" 
                            required
                        >
                        {{-- Catatan: Username juga harus dicek keunikan (Unique Rule) di Controller --}}
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- NAMA LENGKAP --}}
                    {{-- {{ dd($user->nama) }} --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input 
                            type="text" 
                            class="form-control @error('nama') is-invalid @enderror" 
                            id="nama" 
                            name="nama" 
                            value="{{ old('nama', $user->nama) }}" 
                            required
                        >
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
    
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.user_admin') }}" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left me-1" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                            </svg>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save me-1" viewBox="0 0 16 16">
                                <path d="M.5 1a.5.5 0 0 0 0 1h.5v12a.5.5 0 0 0 1 0V2h12a.5.5 0 0 0 0-1z"/>
                                <path d="M14.5 2a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-12a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5zM2 3v12h12V3z"/>
                                <path fill-rule="evenodd" d="M2.5 4a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5v-.5a.5.5 0 0 0-.5-.5H3a.5.5 0 0 0-.5.5z"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection