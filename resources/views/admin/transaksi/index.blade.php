@extends('layouts.admin')

@section('title', 'Daftar Transaksi')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">🧺 Data Transaksi Pelayanan</h1>
        <a href="{{ route('admin.transaksi.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Transaksi Baru
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Pesanan Pelanggan</h6>
            <form action="{{ route('admin.transaksi.index') }}" method="GET"
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-light border-0 small"
                        placeholder="Cari Invoice/Nama..." aria-label="Search" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm">Cari</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{-- Menggunakan table-hover dan thead-dark untuk kontras dan visual yang lebih luas --}}
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th>Kode Invoice & Tanggal Terima</th>
                            <th>Pelanggan & Item</th>
                            <th>Layanan Jasa</th>
                            <th class="text-end">Total Biaya & Pembayaran</th>
                            <th class="text-center">Status Pengerjaan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $trx)
                            {{-- vertical-align: middle memastikan konten tidak terlalu menempel di atas --}}
                            <tr style="vertical-align: middle;">

                                {{-- Kolom Invoice & Tanggal --}}
                                <td>
                                    {{-- Font lebih besar dan bold --}}
                                    <span class="font-weight-bold text-primary fs-6">{{ $trx->kode_invoice }}</span><br>
                                    <small class="text-muted">
                                        Diterima: **{{ \Carbon\Carbon::parse($trx->tanggal_terima)->format('d F Y') }}**
                                    </small>
                                </td>

                                {{-- Kolom Pelanggan --}}
                                <td>
                                    <div class="font-weight-bold text-dark">{{ $trx->user->nama ?? 'User Terhapus' }}</div>
                                    <small class="text-muted">
                                        {{ $trx->jasa->kategori }} : {{ $trx->jumlah_barang }}
                                        @if ($trx->jasa->kategori == 'berat')
                                            Kg
                                        @elseif ($trx->jasa->kategori == 'jumlah')
                                            Pcs
                                        @endif
                                    </small>
                                </td>

                                {{-- Kolom Layanan --}}
                                <td>{{ $trx->jasa->jenis_jasa ?? 'Jasa Terhapus' }}</td>

                                {{-- Kolom Harga & Status Bayar --}}
                                <td class="text-end">
                                    {{-- Harga dibuat sangat besar untuk penekanan --}}
                                    <div class="font-weight-bolder text-dark fs-5">
                                        Rp{{ number_format($trx->total_harga, 0, ',', '.') }}
                                    </div>
                                    @if($trx->status_pembayaran == 'Lunas')
                                        <span class="badge bg-success py-1 px-2 mt-1">Lunas</span>
                                    @else
                                        <span class="badge bg-danger py-1 px-2 mt-1">Belum Lunas</span>
                                    @endif
                                </td>

                                {{-- Kolom Status Pengerjaan (Pengerjaan dibuat tebal dan besar) --}}
                                <td class="text-center">
                                    @php
                                        // Logika untuk menentukan warna badge
                                        $statusClass = match ($trx->status_pengerjaan) {
                                            'Menunggu' => 'secondary',
                                            'Diproses' => 'warning text-dark',
                                            'Selesai' => 'info text-dark',
                                            'Diambil' => 'success',
                                            default => 'light',
                                        };
                                    @endphp
                                    {{-- Badge diberi padding lebih besar (py-2 px-3) --}}
                                    <span class="badge bg-{{ $statusClass }} py-2 px-3 fs-6">
                                        {{ $trx->status_pengerjaan }}
                                    </span>
                                    @if($trx->status_pengerjaan != 'Diambil' && $trx->tanggal_selesai)
                                        <div class="small text-muted mt-1">
                                            Selesai: **{{ \Carbon\Carbon::parse($trx->tanggal_selesai)->format('d M') }}**
                                        </div>
                                    @endif
                                </td>

                                {{-- Kolom Aksi --}}
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.transaksi.show', $trx->id) }}" class="btn btn-sm btn-info"
                                            title="Detail">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('admin.transaksi.edit', $trx->id) }}" class="btn btn-sm btn-warning"
                                            title="Edit Status">
                                            <i class="fas fa-sync"></i> Edit Status
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada data transaksi yang dicatat.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            {{-- <div class="mt-4 d-flex justify-content-center">
                {{ $transaksis->links() }}
            </div> --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $transaksis->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection