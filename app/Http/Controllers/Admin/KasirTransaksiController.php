<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaksi;
use App\Models\Jenis_jasa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KasirTransaksiController extends Controller
{

    public function create()
    {
        $jasas = Jenis_jasa::all();

        return view('admin.kasir.create', compact('jasas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'alamat_pelanggan' => 'nullable|string',
            'no_hp_pelanggan' => 'required|string|max:15',

            'id_jasa' => 'required|exists:jenis_jasas,id',
            'jumlah_barang' => 'required|numeric|min:0.1',

            'status_pembayaran' => 'required|in:Lunas,Belum Lunas',
            'antar_jemput' => 'nullable|boolean',
        ]);

        $jasa = Jenis_jasa::findOrFail($request->id_jasa);

        //LOGIKA ANTAR JEMPUT
        $biayaAntar = $request->antar_jemput ? 5000 : 0;

        $totalHarga = ($jasa->harga * $request->jumlah_barang) + $biayaAntar;

        Transaksi::create([
            'kode_invoice' => 'INV-' . now()->format('Ymd') . '-' . rand(100, 999),

            'sumber_transaksi' => 'kasir',

            //user NULL
            'id_user' => null,

            // data pelanggan manual
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan,
            'no_hp_pelanggan' => $request->no_hp_pelanggan,

            'id_jasa' => $request->id_jasa,
            'jumlah_barang' => $request->jumlah_barang,
            'total_harga' => $totalHarga,
            'description' => 'Transaksi Kasir',

            'antar_jemput' => $request->antar_jemput ?? false,
            'biaya_antar_jemput' => $biayaAntar,

            'status_pembayaran' => $request->status_pembayaran,
            'status_pengerjaan' => 'Menunggu',

            'tanggal_terima' => now(),
        ]);

        return redirect()
            ->route('admin.transaksi.index')
            ->with('success', 'Transaksi kasir berhasil dibuat');
    }
}
