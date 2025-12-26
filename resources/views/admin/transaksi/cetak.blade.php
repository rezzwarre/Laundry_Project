<body onload="window.print()">

    <h4 style="text-align:center;">NOTA LAUNDRY</h4>
    <hr>

    <p><strong>Invoice:</strong> {{ $transaksi->kode_invoice }}</p>
    <p><strong>Pelanggan:</strong> {{ $transaksi->user->nama }}</p>
    <p><strong>Tanggal:</strong> {{ $transaksi->tanggal_terima }}</p>

    <hr>

    <p>Layanan : {{ $transaksi->jasa->jenis_jasa }}</p>

    <td class="fw-bold">Barang</td>
    <td>: {{ $transaksi->jasa->jenis_barang ?? 'N/A' }}</td>
    <br>
    <br>
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

    <p>Harga Satuan : Rp{{ number_format($transaksi->jasa->harga) }}</p>
    <p>Deskripsi : {{ $transaksi->description }}</p>
    <p>Antar Jemput : {{ $transaksi->antar_jemput ? 'Ya' : 'Tidak' }}</p>
    <p>Biaya Ongkir : Rp{{ number_format($transaksi->biaya_antar_jemput) }}</p>

    <hr>

    <h4>Total: Rp{{ number_format($transaksi->total_harga) }}</h4>

</body>