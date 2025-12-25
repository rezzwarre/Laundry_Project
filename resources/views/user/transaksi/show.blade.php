@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">

            <div class="card shadow mb-4">

                {{-- Header --}}
                <div class="card-header py-3 bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold">
                        Nota Transaksi: {{ $transaksi->kode_invoice }}
                    </h5>

                    <div class="d-flex align-items-center">          
                        <a href="{{ route('user.transaksi.index') }}" class="btn btn-sm btn-light">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                {{-- Body --}}
                <div class="card-body">

                    {{-- Informasi Umum --}}
                    <h6 class="font-weight-bold mb-3 text-secondary">INFORMASI UMUM</h6>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">Pelanggan</label>
                            <p class="text-dark">{{ $transaksi->user->nama ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">Tanggal Terima</label>
                            <p class="text-dark">
                                {{ \Carbon\Carbon::parse($transaksi->tanggal_terima)->format('d F Y') }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">Alamat</label>
                            <p class="text-dark">{{ $transaksi->user->alamat ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">No.Telpon</label>
                            <p class="text-dark">{{ $transaksi->user->no_hp ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <hr>

                    {{-- Rincian Pesanan --}}
                    <h6 class="font-weight-bold mb-3 text-secondary">RINCIAN PESANAN</h6>

                    <table class="table table-sm table-borderless mb-4">
                        <tr>
                            <td class="fw-bold" style="width: 30%;">Layanan Jasa</td>
                            <td>: <strong>{{ $transaksi->jasa->jenis_jasa ?? 'N/A' }}</strong></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Barang</td>
                            <td>: {{ $transaksi->jasa->jenis_barang ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold"><strong>{{ $transaksi->jasa->kategori }}</strong></td>
                            <td>: <strong>
                                    {{ $transaksi->jumlah_barang }}
                                    @if ($transaksi->jasa->kategori == 'berat')
                                        Kg
                                    @elseif ($transaksi->jasa->kategori == 'jumlah')
                                        Pcs
                                    @endif
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Harga Satuan</td>
                            <td>: Rp{{ number_format($transaksi->jasa->harga ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="table-light fw-bold">
                            <td>TOTAL HARGA</td>
                            <td>: <strong>Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</strong></td>
                        </tr>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">deskripsi Lengkap</label>
                            <textarea readonly class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description" rows="6"
                                placeholder="Jelaskan detail layanan Anda, misalnya: Syarat & Ketentuan, durasi, dll."
                                required>{{ old('description', $transaksi->description ?? '') }}</textarea>

                            {{-- Penanganan Error untuk field description --}}
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text">Maksimal 1000 karakter.</div>
                        </div>
                    </table>

                    <hr>

                    {{-- Status & Penyelesaian --}}
                    <h6 class="font-weight-bold mb-3 text-secondary">STATUS & PENYELESAIAN</h6>

                    <div class="row">

                        {{-- Status Pengerjaan --}}
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">Status Pengerjaan</label><br>

                            @php
                                $statusClass = [
                                    'Menunggu' => 'secondary',
                                    'Diproses' => 'warning',
                                    'Selesai' => 'info',
                                    'Diambil' => 'success'
                                ][$transaksi->status_pengerjaan] ?? 'light';
                            @endphp

                            <span class="badge bg-{{ $statusClass }} p-2">
                                {{ $transaksi->status_pengerjaan }}
                            </span>
                        </div>

                        {{-- Status Pembayaran --}}
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">Status Pembayaran</label><br>
                            <span
                                class="badge bg-{{ $transaksi->status_pembayaran == 'Lunas' ? 'success' : 'danger' }} p-2">
                                {{ $transaksi->status_pembayaran }}
                            </span>
                        </div>

                        {{-- Estimasi Selesai --}}
                        <div class="col-md-12">
                            <label class="font-weight-bold">Estimasi / Tanggal Selesai</label>
                            <p class="text-dark">
                                {{ $transaksi->tanggal_selesai
        ? \Carbon\Carbon::parse($transaksi->tanggal_selesai)->format('d F Y')
        : '-' 
                                            }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection