@extends('layouts.admin')

@section('title', 'Laporan Keuangan & Operasional')

@section('content')
    <style>
        /* Mengurangi margin pada card-body untuk tampilan laporan yang ringkas */
        .card-report .card-body {
            padding: 1rem !important;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">📈 Laporan Keuangan dan Operasional</h1>
    </div>

    {{-- FORM FILTER TANGGAL --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-secondary">Filter Laporan Berdasarkan Tanggal Diterima</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.laporan.index') }}" method="GET" id="form-filter-laporan">
                <div class="row align-items-end">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Dari Tanggal</label>
                        {{-- Tambahkan ID pada input untuk diakses JavaScript --}}
                        <input type="date" name="start_date" id="start_date_input" class="form-control"
                            value="{{ request('start_date') ?? $startDate->format('Y-m-d') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sampai Tanggal</label>
                        {{-- Tambahkan ID pada input untuk diakses JavaScript --}}
                        <input type="date" name="end_date" id="end_date_input" class="form-control"
                            value="{{ request('end_date') ?? $endDate->format('Y-m-d') }}">
                    </div>
                    <div class="col-md-4 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary flex me-2">
                            <i class="fas fa-filter"></i> Terapkan Filter
                        </button>
                        {{-- TOMBOL CETAK PDF --}}
                        <button type="button" id="btn-cetak-pdf" class="btn btn-danger" title="Cetak PDF">
                            <i class="fas fa-file-pdf">Cetak PDF</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- SUMMARY CARDS FINANSIAL --}}
    <div class="row mb-4">
        {{-- ... (Summary Cards yang sudah ada) ... --}}
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body card-report">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Pendapatan (Lunas)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp{{ number_format($totalIncome, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body card-report">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Piutang (Belum Lunas)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp{{ number_format($totalReceivable, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body card-report">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Transaksi
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($totalOrders, 0, ',', '.') }} Pesanan
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body card-report">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Rata-Rata Nilai Pesanan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp{{ number_format($averageOrderValue, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END SUMMARY CARDS --}}


    {{-- TABEL DETAIL LAPORAN --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                Data Transaksi Periode {{ $startDate->format('d M Y') }} s/d {{ $endDate->format('d M Y') }}
            </h6>

             {{-- Tombol Cetak PDF diletakkan di sini jika menggunakan cara JavaScript/URL --}}
            {{-- Karena sudah ditaruh di form filter di atas, bagian ini dikosongkan --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>Invoice</th>
                            <th>Tanggal Terima</th>
                            <th>Pelanggan</th>
                            <th>Layanan</th>
                            <th class="text-end">Total Harga</th>
                            <th class="text-center">Status Bayar</th>
                            <th class="text-center">Status Kerja</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $trx)
                            <tr style="vertical-align: middle;">
                                <td>{{ $trx->kode_invoice }}</td>
                                <td>{{ \Carbon\Carbon::parse($trx->tanggal_terima)->format('d M Y') }}</td>
                                {{-- PERHATIAN: Asumsi kolom pelanggan di tabel users adalah 'name', bukan 'nama' --}}
                                <td>{{ $trx->user->name ?? 'User N/A' }}</td> 
                                <td>{{ $trx->jasa->jenis_jasa ?? 'Jasa N/A' }} ({{ $trx->jumlah_barang }})</td>

                                <td class="text-end font-weight-bold">
                                    Rp{{ number_format($trx->total_harga, 0, ',', '.') }}
                                </td>

                                {{-- Status Bayar --}}
                                <td class="text-center">
                                    @if($trx->status_pembayaran == 'Lunas')
                                        <span class="badge bg-success py-1 px-2">Lunas</span>
                                    @else
                                        <span class="badge bg-danger py-1 px-2">Belum Lunas</span>
                                    @endif
                                </td>

                                {{-- Status Pengerjaan --}}
                                <td class="text-center">
                                    @php
                                        $statusClass = match ($trx->status_pengerjaan) {
                                            'Menunggu' => 'secondary',
                                            'Diproses' => 'warning text-dark',
                                            'Selesai' => 'info text-dark',
                                            'Diambil' => 'success',
                                            default => 'light',
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }} py-1 px-2">
                                        {{ $trx->status_pengerjaan }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="fas fa-sad-tear fa-2x text-muted mb-2"></i>
                                    <p class="text-muted">Tidak ada data transaksi yang ditemukan pada periode ini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $reports->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    {{-- SCRIPTS UNTUK CETAK PDF --}}
    <script>
        document.getElementById('btn-cetak-pdf').addEventListener('click', function() {
            // Ambil nilai dari input filter tanggal
            let startDate = document.getElementById('start_date_input').value; 
            let endDate = document.getElementById('end_date_input').value;   

            // URL route generate PDF
            let url = "{{ route('admin.laporan.generate') }}"; 
            
            // Tambahkan parameter filter ke URL
            if (startDate && endDate) {
                url += `?start_date=${startDate}&end_date=${endDate}`;
            }
            
            // Buka PDF di tab baru
            window.open(url, '_blank'); 
        });
    </script>
@endsection