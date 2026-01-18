@extends('layouts.admin')

@section('title', 'Tambah Admin')

@section('content')

    <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.user_admin.store') }}">
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
                    </form>
                </div>
@endsection