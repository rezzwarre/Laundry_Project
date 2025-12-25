@extends('layouts.app')

@section('title', 'Riwayat Transaksi Saya')

@section('content')
    <h2 class="mb-4">Riwayat Pesanan Laundry</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            @if ($transaksis->isEmpty())
                <div class="alert alert-info text-center">
                    Anda belum memiliki riwayat transaksi. <a href="{{ route('user.transaksi.create') }}">Buat Pesanan
                        Sekarang!</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Kode Transaksi</th>
                                <th>Layanan Utama</th>
                                <th>Item</th>
                                <th>Total Tagihan</th>
                                <th>Status Pengerjaan</th>
                                <th>Status Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksis as $t)
                                <tr>
                                    <td><span class="badge bg-primary">{{ $t->kode_invoice }}</span></td>
                                    <td>{{ $t->jasa->jenis_jasa ?? 'N/A' }}</td>
                                    {{-- Kolom Pelanggan --}}
                                    <td>
                                        {{ $t->jasa->kategori }} : {{ $t->jumlah_barang }}
                                        @if ($t->jasa->kategori == 'berat')
                                            Kg
                                        @elseif ($t->jasa->kategori == 'jumlah')
                                            Pcs
                                        @endif
                                    </td>
                                    <td>
                                        @if ($t->total_harga > 0)
                                            Rp{{ number_format($t->total_harga, 0, ',', '.') }}
                                        @else
                                            <span class="text-muted">Menunggu Verifikasi</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @php
                                            // Logika untuk menentukan warna badge
                                            $statusClass = match ($t->status_pengerjaan) {
                                                'Menunggu' => 'secondary',
                                                'Diproses' => 'warning text-dark',
                                                'Selesai' => 'info text-dark',
                                                'Diambil' => 'success',
                                                default => 'light',
                                            };
                                        @endphp
                                        {{-- Badge diberi padding lebih besar (py-2 px-3) --}}
                                        <span class="badge bg-{{ $statusClass }} py-2 px-3 fs-6">
                                            {{ $t->status_pengerjaan }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge bg-{{ $t->status_pembayaran == 'Lunas' ? 'success' : 'danger' }}">
                                            {{ $t->status_pembayaran }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('user.transaksi.show', $t->id) }}"
                                            class="btn btn-sm btn-outline-primary">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection