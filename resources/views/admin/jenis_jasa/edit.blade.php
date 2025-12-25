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
                {{-- Value: Menggunakan old() untuk input baru, dan $jenis_jasa->jenis_jasa untuk nilai DB --}}
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
                <label for="jenis_barang" class="form-label">Jenis Barang (Satuan)</label>
                <input type="text" 
                       class="form-control @error('jenis_barang') is-invalid @enderror" 
                       id="jenis_barang" 
                       name="jenis_barang" 
                       value="{{ old('jenis_barang', $jenis_jasa->jenis_barang) }}"
                       placeholder="Contoh: Kg / Pcs / Sepatu">
                
                @error('jenis_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- START TAMBAHAN: Pilih Kategori --}}
            <div class="mb-3">
                <label for="kategori" class="form-label font-weight-bold">Kategori Perhitungan</label>
                <select name="kategori" id="kategori" class="form-control form-select @error('kategori') is-invalid @enderror">
                    <option value="" disabled>-- Pilih Kategori --</option>
                    
                    {{-- Opsi 1: BERAT (Mengizinkan Desimal) --}}
                    <option value="berat" 
                        {{ 
                            old('kategori', $jenis_jasa->kategori) == 'berat' ? 'selected' : '' 
                        }}>
                        Berat (Mengizinkan Desimal, contoh: 1.5 Kg)
                    </option>
                    
                    {{-- Opsi 2: JUMLAH (Hanya Bilangan Bulat) --}}
                    <option value="jumlah" 
                        {{ 
                            old('kategori', $jenis_jasa->kategori) == 'jumlah' ? 'selected' : '' 
                        }}>
                        Jumlah (Hanya Bilangan Bulat, contoh: 2 Pcs)
                    </option>
                </select>
                <small class="text-muted">Tentukan apakah kuantitas barang boleh berupa desimal (seperti berat) atau harus bilangan bulat (seperti jumlah).</small>
                @error('kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- END TAMBAHAN --}}

            {{-- Input Harga --}}
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Satuan (Rp)</label>
                <input type="number" 
                       class="form-control @error('harga') is-invalid @enderror" 
                       id="harga" 
                       name="harga" 
                       value="{{ old('harga', $jenis_jasa->harga) }}"
                       step="0.01" min="0">
                <small class="text-muted">Masukkan harga per satuan (per Kg, per Pcs, dll.).</small>
                
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