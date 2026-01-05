@extends('layouts.app')

@section('title', 'Buat Pesanan Laundry')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">Pesan Layanan Laundry</h4>
                </div>
                <div class="card-body">

                    @error('error')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <form method="POST" action="{{ route('user.transaksi.store') }}">
                        @csrf

                        {{-- 1. PILIH JENIS JASA --}}
                        <div class="mb-4">
                            <label class="form-label font-weight-bold">Pilih Layanan (Jasa)</label>

                            <select name="id_jasa" id="select-jasa"
                                class="form-control form-select @error('id_jasa') is-invalid @enderror">
                                <option value="" data-harga="0" data-satuan="" data-kategori="">-- Pilih Jasa --
                                </option>
                                @foreach($jenis_jasas as $jasa)
                                    {{-- MODIFIKASI: Menambahkan data-kategori --}}
                                    <option value="{{ $jasa->id }}" data-harga="{{ $jasa->harga }}"
                                        data-satuan="{{ $jasa->jenis_barang }}"
                                        data-kategori="{{ strtolower($jasa->kategori) }}">
                                        {{ $jasa->jenis_jasa }} -
                                        Rp{{ number_format($jasa->harga, 0, ',', '.') }}/{{ $jasa->jenis_barang }}-({{ $jasa->kategori }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_jasa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- INFORMASI PENGUKURAN DAN HARGA (DITUTUP) --}}
                        <div class="alert alert-warning">
                            **Penting:** Berat/Jumlah Barang dan Total Tagihan akan ditentukan dan diverifikasi oleh Admin
                            setelah barang Anda kami terima.
                            1 pcs sepatu = sepasang sepatu
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Antar Jemput? (Rp5.000)</label><br>

                            <input type="radio" name="antar_jemput" value="1"> Ya
                            <input type="radio" name="antar_jemput" value="0" checked> Tidak
                        </div>

                        {{-- 2. CATATAN / DESKRIPSI (Kolom baru) --}}
                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Deskripsi Tambahan untuk Admin
                                (Opsional)</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description" rows="3"
                                placeholder="Contoh: Ada noda khusus di kemeja biru, mohon hati-hati saat mencuci.">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-info btn-lg text-white">Buat Pesanan Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection