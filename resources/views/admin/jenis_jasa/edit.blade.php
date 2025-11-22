@extends('layouts.admin')

@section('title', 'Edit Jenis Jasa')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Edit Jenis Jasa</h6>
    </div>
    <div class="card-body">
        {{-- Perhatikan route mengirim ID --}}
        <form action="{{ route('admin.jenis_jasa.update', $jenis_jasa->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- WAJIB: Mengubah method POST menjadi PUT untuk update --}}

            {{-- Input Jenis Jasa --}}
            <div class="mb-3">
                <label for="jenis_jasa" class="form-label">Jenis Jasa</label>
                {{-- Value: Jika ada input baru (habis error) pakai old(), jika tidak pakai data dari DB --}}
                <input type="text" 
                       class="form-control @error('jenis_jasa') is-invalid @enderror" 
                       id="jenis_jasa" 
                       name="jenis_jasa" 
                       value="{{ old('jenis_jasa', $jenis_jasa->jenis_jasa) }}">
                
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
                       value="{{ old('jenis_barang', $jenis_jasa->jenis_barang) }}">
                
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
                       value="{{ old('harga', $jenis_jasa->harga) }}">
                
                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Data</button>
            <a href="{{ route('admin.jenis_jasa.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection