@extends('layouts.admin')

@section('title', 'Edit Transaksi ' . $transaksi->kode_invoice)

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-warning text-dark">
                <h6 class="m-0 font-weight-bold">🛠️ Edit Transaksi: {{ $transaksi->kode_invoice }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.transaksi.update', $transaksi->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Wajib untuk method Update --}}

                    {{-- Status Pengerjaan (Paling sering diubah) --}}
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Status Pengerjaan</label>
                        <select name="status_kerja" class="form-control form-select">
                            @foreach(['Menunggu', 'Diproses', 'Selesai', 'Diambil'] as $status)
                                <option value="{{ $status }}" 
                                    {{ old('status_kerja', $transaksi->status_pengerjaan) == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status Pembayaran --}}
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Status Pembayaran</label>
                        <select name="status_bayar" class="form-control form-select">
                            <option value="Belum Lunas" {{ old('status_bayar', $transaksi->status_pembayaran) == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                            <option value="Lunas" {{ old('status_bayar', $transaksi->status_pembayaran) == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                        </select>
                        @error('status_bayar') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <hr>
                    <h6 class="font-weight-bold mb-3 text-secondary">DATA TRANSAKSI (HATI-HATI MENGUBAH)</h6>

                    {{-- Pilih Pelanggan --}}
                    <div class="mb-3">
                        <label class="form-label">Pelanggan</label>
                        <select name="id_user" class="form-control form-select @error('id_user') is-invalid @enderror">
                            @foreach($customers as $user)
                                <option value="{{ $user->id }}" 
                                    {{ old('id_user', $transaksi->id_user) == $user->id ? 'selected' : '' }}>
                                    {{ $user->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Baris Layanan & Jumlah --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pilih Layanan (Jasa)</label>
                            <select name="id_jasa" id="select-jasa" class="form-control form-select @error('id_jasa') is-invalid @enderror">
                                @foreach($services as $jasa)
                                    <option value="{{ $jasa->id }}" data-harga="{{ $jasa->harga }}"
                                        {{ old('id_jasa', $transaksi->id_jasa) == $jasa->id ? 'selected' : '' }}>
                                        {{ $jasa->jenis_jasa }} - Rp{{ number_format($jasa->harga, 0, ',', '.') }}/{{ $jasa->jenis_barang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jumlah / Berat</label>
                            <input type="number" name="jumlah_barang" id="input-jumlah" class="form-control @error('jumlah_barang') is-invalid @enderror" value="{{ old('jumlah_barang', $transaksi->jumlah_barang) }}" min="1">
                        </div>
                    </div>
                    
                    <div class="alert alert-info d-flex justify-content-between align-items-center">
                        <span>Harga akan dihitung ulang otomatis saat disubmit. Estimasi:</span>
                        <h3 class="mb-0 font-weight-bold" id="tampilan-harga">Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</h3>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Terima</label>
                        <input type="date" name="tanggal_terima" class="form-control" value="{{ old('tanggal_terima', $transaksi->tanggal_terima) }}">
                    </div>

                    <button type="submit" class="btn btn-warning btn-lg w-100 mt-3">
                        <i class="fas fa-save"></i> Perbarui Transaksi
                    </button>
                    <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary w-100 mt-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Script JS yang sama dari Create untuk kalkulasi dinamis --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectJasa = document.getElementById('select-jasa');
        const inputJumlah = document.getElementById('input-jumlah');
        const tampilanHarga = document.getElementById('tampilan-harga');

        function hitungHarga() {
            const hargaSatuan = selectJasa.options[selectJasa.selectedIndex].getAttribute('data-harga') || 0;
            const jumlah = inputJumlah.value || 0;
            const total = hargaSatuan * jumlah;
            tampilanHarga.innerText = "Rp " + new Intl.NumberFormat('id-ID').format(total);
        }
        // Pastikan harga awal terhitung saat halaman dimuat
        hitungHarga(); 

        selectJasa.addEventListener('change', hitungHarga);
        inputJumlah.addEventListener('input', hitungHarga);
    });
</script>
@endsection