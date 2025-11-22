@extends('layouts.admin')

@section('title', 'Tambah Jenis Jasa')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Jenis Jasa</h6>
    </div>
    <div class="card-body">
        {{-- Form mengarah ke route store --}}
        <form action="{{ route('admin.jenis_jasa.store') }}" method="POST">
            @csrf {{-- Wajib ada untuk keamanan --}}

            {{-- Input Jenis Jasa --}}
            <div class="mb-3">
                <label for="jenis_jasa" class="form-label">Jenis Jasa</label>
                <input type="text" 
                       class="form-control @error('jenis_jasa') is-invalid @enderror" 
                       id="jenis_jasa" 
                       name="jenis_jasa" 
                       value="{{ old('jenis_jasa') }}" 
                       placeholder="Contoh: Cuci Kering">
                
                {{-- Menampilkan error validasi --}}
                @error('jenis_jasa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Jenis Barang --}}
            <div class="mb-3">
                <label for="jenis_barang" class="form-label">Jenis Barang</label>
                <input type="text" 
                       class="form-control @error('jenis_barang') is-invalid @enderror" 
                       id="jenis_barang" 
                       name="jenis_barang" 
                       value="{{ old('jenis_barang') }}" 
                       placeholder="Contoh: Karpet / Baju / Sepatu">
                
                @error('jenis_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Harga --}}
            <div class="mb-3">
                <label for="harga" class="form-label">Harga (Rp)</label>
                <input type="number" 
                       class="form-control @error('harga') is-invalid @enderror" 
                       id="harga" 
                       name="harga" 
                       value="{{ old('harga') }}" 
                       placeholder="Contoh: 15000">
                <small class="text-muted">Masukkan angka saja tanpa titik atau koma.</small>

                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <a href="{{ route('admin.jenis_jasa.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection