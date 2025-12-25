<!DOCTYPE html>
<html>

<head>
    <title>Laporan Transaksi Periode {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}</title>
    <style>
        /* ... CSS SAMA ... */
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 30px;
        }

        h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        .summary-box {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
            display: inline-block;
            width: 100%;
            background-color: #f8f8f8;
        }

        .summary-item {
            width: 48%;
            float: left;
            margin-bottom: 5px;
        }

        .summary-table {
            width: 100%;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            background-color: #f8f8f8;
        }

        .summary-table td {
            border: none;
            padding: 5px 10px;
        }

        .summary-table .header-row {
            font-weight: bold;
            background-color: #eee;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4e73df;
            color: white;
            text-align: center;
            font-size: 11px;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .status-lunas {
            background-color: #c6f6d5;
        }

        .status-piutang {
            background-color: #fed7d7;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 8px;
        }
    </style>

</head>

<body>

    <h4>LAPORAN TRANSAKSI LAUNDRY<br>Periode: {{ $startDate->format('d F Y') }} s/d {{ $endDate->format('d F Y') }}</h4>

    {{-- Ringkasan Keuangan (DIGANTI menggunakan variabel yang sudah dihitung) --}}
    {{-- Ringkasan Keuangan (DIGANTI DENGAN STRUKTUR TABEL) --}}
    <table class="summary-table">
        <tr>
            <td style="width: 25%;"><strong>Total Pendapatan (Lunas):</strong></td>
            <td style="width: 25%;" class="text-right">Rp{{ number_format($totalIncome, 0, ',', '.') }}</td>

            <td style="width: 25%;"><strong>Total Pesanan:</strong></td>
            <td style="width: 25%;" class="text-right">{{ $totalOrders }}</td>
        </tr>
        <tr>
            <td><strong>Total Piutang:</strong></td>
            <td class="text-right">Rp{{ number_format($totalReceivable, 0, ',', '.') }}</td>

            <td><strong>Dicetak:</strong></td>
            <td class="text-right">{{ now()->format('d M Y H:i') }}</td>
        </tr>
    </table>

    {{-- Tabel Detail --}}
    <table>
        <thead>
            <tr>
                <th style="width: 10%;">Invoice</th>
                <th style="width: 15%;">Tanggal Terima</th>
                <th style="width: 25%;">Pelanggan</th>
                <th style="width: 15%;">Layanan</th>
                <th style="width: 15%;">Harga Total</th>
                <th style="width: 10%;">Bayar</th>
                <th style="width: 10%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $trx)
                <tr class="{{ $trx->status_pembayaran == 'Lunas' ? 'status-lunas' : 'status-piutang' }}">
                    <td>{{ $trx->kode_invoice }}</td>
                    <td>{{ \Carbon\Carbon::parse($trx->tanggal_terima)->format('d/m/Y') }}</td>
                    {{-- Perbaikan: Mengganti $trx->user->nama menjadi $trx->user->name --}}
                    <td>{{ $trx->user->nama ?? 'N/A' }}</td>
                    <td>{{ $trx->jasa->jenis_jasa ?? 'N/A' }} <strong>
                            {{ $trx->jumlah_barang }}
                            @if ($trx->jasa->kategori == 'berat')
                                Kg
                            @elseif ($trx->jasa->kategori == 'jumlah')
                                Pcs
                            @endif
                        </strong></td>
                    <td class="text-right">Rp{{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $trx->status_pembayaran == 'Lunas' ? 'Lunas' : 'Piutang' }}</td>
                    <td class="text-center">{{ $trx->status_pengerjaan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dokumen ini dicetak otomatis dari Sistem Laundry.
    </div>
</body>

</html>