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
                <label for="jenis_barang" class="form-label">Jenis Barang (Satuan)</label>
                <input type="text" 
                       class="form-control @error('jenis_barang') is-invalid @enderror" 
                       id="jenis_barang" 
                       name="jenis_barang" 
                       value="{{ old('jenis_barang') }}" 
                       placeholder="Contoh: Kg / Pcs / Sepatu">
                
                @error('jenis_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- START TAMBAHAN: Pilih Kategori --}}
            <div class="mb-3">
                <label for="kategori" class="form-label font-weight-bold">Kategori</label>
                <select name="kategori" id="kategori" class="form-control form-select @error('kategori') is-invalid @enderror">
                    {{-- Nilai old() akan menjaga pilihan jika terjadi error validasi --}}
                    <option value="" disabled selected>-- Pilih Kategori --</option>
                    <option value="berat" {{ old('kategori') == 'berat' ? 'selected' : '' }}>Berat (Mengizinkan, contoh: 1.5 Kg)</option>
                    <option value="jumlah" {{ old('kategori') == 'jumlah' ? 'selected' : '' }}>Jumlah (Hanya, contoh: 2 Pcs)</option>
                </select>
                <small class="text-muted">Tentukan untuk satuan kategori apa</small>
                @error('kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- END TAMBAHAN --}}


            {{-- Input Harga --}}
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Satuan (Rp)</label>
                {{-- Menggunakan step="0.01" untuk harga desimal (jika di DB menggunakan DECIMAL) --}}
                <input type="number" 
                       class="form-control @error('harga') is-invalid @enderror" 
                       id="harga" 
                       name="harga" 
                       value="{{ old('harga') }}" 
                       placeholder="Contoh: 15000"
                       step="0.01" min="0"> 
                <small class="text-muted">Masukkan harga per satuan (per Kg, per Pcs, dll.).</small>

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