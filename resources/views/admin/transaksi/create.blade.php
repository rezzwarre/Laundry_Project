@extends('layouts.admin')

@section('title', 'Transaksi Baru')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Transaksi Laundry</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.transaksi.store') }}" method="POST">
                        @csrf

                        {{-- Pilih Pelanggan --}}
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Pelanggan</label>
                            <select name="id_user" class="form-control form-select @error('id_user') is-invalid @enderror">
                                <option value="">-- Pilih Pelanggan --</option>
                                @foreach($customers as $user)
                                    <option value="{{ $user->id }}">{{ $user->nama }} (ID: {{ $user->id }})</option>
                                @endforeach
                            </select>
                            @error('id_user') <div class="invalid-feedback">{{ $message }}</div> @enderror

                        </div>

                        {{-- Baris Layanan & Jumlah --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Pilih Layanan (Jasa)</label>
                                {{-- Kita simpan harga di atribut 'data-harga' agar bisa dibaca JS --}}
                                <select name="id_jasa" id="select-jasa"
                                    class="form-control form-select @error('id_jasa') is-invalid @enderror">
                                    <option value="" data-harga="0">-- Pilih Jasa --</option>
                                    @foreach($services as $jasa)
                                        <option value="{{ $jasa->id }}" data-harga="{{ $jasa->harga }}">
                                            {{ $jasa->jenis_jasa }} -
                                            Rp{{ number_format($jasa->harga, 0, ',', '.') }}/{{ $jasa->jenis_barang }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_jasa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Jumlah / Berat</label>
                                <input type="number" name="jumlah_barang" id="input-jumlah"
                                    class="form-control @error('jumlah_barang') is-invalid @enderror" value="1" min="1">
                                <small class="text-muted">Satuan mengikuti jenis jasa (Kg/Pcs)</small>
                                @error('jumlah_barang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        {{-- Informasi Tagihan (Otomatis) --}}
                        <div class="alert alert-info d-flex justify-content-between align-items-center">
                            <span>Estimasi Total Harga:</span>
                            <h3 class="mb-0 font-weight-bold" id="tampilan-harga">Rp 0</h3>
                        </div>

                        {{-- Tanggal & Pembayaran --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Terima</label>
                                <input type="date" name="tanggal_terima" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Status Pembayaran</label>
                                <select name="status_bayar" class="form-control form-select">
                                    <option value="Belum Lunas">Belum Lunas</option>
                                    <option value="Lunas">Lunas (Bayar Sekarang)</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 mb-2">
                                <button type="submit" class="btn btn-success btn-lg w-100">
                                    <i class="fas fa-save"></i> Simpan Transaksi
                                </button>
                            </div>

                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary btn-lg w-100">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Card Informasi Samping (Opsional) --}}
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-secondary">Info Cepat</h6>
                </div>
                <div class="card-body">
                    <p>Pastikan pelanggan sudah terdaftar sebelum membuat transaksi. Jika belum, daftarkan di menu
                        Pelanggan.</p>
                    <hr>
                    <strong>Alur Kerja:</strong>
                    <ol class="pl-3">
                        <li>Terima barang</li>
                        <li>Input data di sini</li>
                        <li>Cetak Struk (di halaman detail)</li>
                        <li>Proses Cuci</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Script JavaScript untuk Hitung Harga Otomatis --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectJasa = document.getElementById('select-jasa');
            const inputJumlah = document.getElementById('input-jumlah');
            const tampilanHarga = document.getElementById('tampilan-harga');

            function hitungHarga() {
                // Ambil harga dari atribut data-harga pada option yang dipilih
                const hargaSatuan = selectJasa.options[selectJasa.selectedIndex].getAttribute('data-harga') || 0;
                const jumlah = inputJumlah.value || 0;

                const total = hargaSatuan * jumlah;

                // Format Rupiah sederhana
                tampilanHarga.innerText = "Rp " + new Intl.NumberFormat('id-ID').format(total);
            }

            // Jalankan fungsi saat user mengubah pilihan atau angka
            selectJasa.addEventListener('change', hitungHarga);
            inputJumlah.addEventListener('input', hitungHarga);
        });
    </script>
@endsection