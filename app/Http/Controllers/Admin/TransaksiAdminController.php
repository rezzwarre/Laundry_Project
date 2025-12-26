<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Jenis_jasa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransaksiAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // // Ambil data transaksi, urutkan dari yang terbaru
        // // 'with' digunakan untuk Eager Loading (Mencegah query berulang-ulang)
        // $transaksis = Transaksi::with(['user', 'jasa'])
        //     ->latest()
        //     ->paginate(10); // Tampilkan 10 per halaman

        // return view('admin.transaksi.index', compact('transaksis'));

        $query = Transaksi::with(['user', 'jasa']);

        // LOGIKA PENCARIAN
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;

            $query->where(function ($q) use ($searchTerm) {
                // 1. Mencari berdasarkan Kode Invoice
                $q->where('kode_invoice', 'like', '%' . $searchTerm . '%')

                    // 2. Mencari berdasarkan Nama Pelanggan (JOIN/Relationship)
                    ->orWhereHas('user', function ($q_user) use ($searchTerm) {
                        $q_user->where('nama', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        // Ambil data yang sudah difilter/dicari
        $transaksis = $query->latest()->paginate(10);

        // Kirim data ke view
        return view('admin.transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 1. Ambil data Pelanggan (User) dan Layanan (Jasa) untuk Dropdown
        // Jika Anda punya role, filter: User::where('role', 'customer')->get();
        $customers = User::all();
        $services  = Jenis_jasa::all();

        return view('admin.transaksi.create', compact('customers', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'id_user'       => 'required|exists:users,id',
            'id_jasa'       => 'required|exists:jenis_jasas,id',
            'jumlah_barang' => 'required|numeric|min:0.1',
            'description'     => 'required|string|max:1000',
            'tanggal_terima' => 'required|date',
            'status_bayar'  => 'required|in:Lunas,Belum Lunas',
            'antar_jemput' => 'nullable|boolean', // Kolom antar jemput baru
        ]);

        $biayaAntarJemput = $request->antar_jemput ? 5000 : 0;
        // 2. Ambil data jasa untuk hitung harga valid
        $jasa = Jenis_jasa::findOrFail($request->id_jasa);
        $totalHarga = ($jasa->harga * $request->jumlah_barang) + $biayaAntarJemput;



        // 3. Generate Kode Invoice (Format: INV-TAHUNBULANTANGGAL-RANDOM)
        // Contoh: INV-20231122-A1B
        $kodeInvoice = 'INV-' . Carbon::now()->format('Ymd') . '-' . strtoupper(Str::random(3));

        // 4. Simpan ke Database
        Transaksi::create([
            'kode_invoice'      => $kodeInvoice,
            'id_user'           => $request->id_user,
            'id_jasa'           => $request->id_jasa,
            'jumlah_barang'     => $request->jumlah_barang,
            'total_harga'       => $totalHarga,
            'description'         => $request->description,
            'status_pembayaran' => $request->status_bayar,
            'tanggal_terima'    => $request->tanggal_terima,
            // Estimasi selesai otomatis +2 hari (bisa diedit nanti)
            'tanggal_selesai'   => Carbon::parse($request->tanggal_terima)->addDays(2),
            'status_pengerjaan' => 'Menunggu', // Default status
            'antar_jemput'      => $request->antar_jemput ?? false,
            'biaya_antar_jemput' => $biayaAntarJemput,
        ]);

        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Transaksi baru berhasil dibuat!');
    }

    /**
     * Menampilkan detail satu transaksi
     */
    public function show($id)
    {
        // Ambil data transaksi beserta relasinya
        $transaksi = Transaksi::with(['user', 'jasa'])->findOrFail($id);

        return view('admin.transaksi.show', compact('transaksi'));
    }

    /**
     * Menampilkan form edit transaksi
     */
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Perlu data ini untuk dropdown di form edit
        $customers = User::all();
        $services  = Jenis_jasa::all();

        return view('admin.transaksi.edit', compact('transaksi', 'customers', 'services'));
    }

    /**
     * Memperbarui data transaksi yang sudah ada
     */
    public function update(Request $request, $id)
    {
        // 1. Validasi Input
        $request->validate([
            'id_user'       => 'required|exists:users,id',
            'id_jasa'       => 'required|exists:jenis_jasas,id',
            'jumlah_barang' => 'required|numeric|min:0.0',
            'description'     => 'required|string|max:1000',
            'tanggal_terima' => 'required|date',
            'status_bayar'  => 'required|in:Lunas,Belum Lunas',
            'status_kerja'  => 'required|in:Menunggu,Dijemput,Diproses,Selesai,Diantar,Diambil',
            'antar_jemput' => 'nullable|boolean', // Kolom antar jemput baru
        ]);


        $statusKerja = $request->status_kerja;
        $antarJemput = $request->antar_jemput ?? false;

        // ✅ LOGIKA BIAYA ANTAR JEMPUT
        $biayaAntarJemput = 0;
        if ($antarJemput && !in_array($statusKerja, ['Menunggu', 'Dijemput'])) {
            $biayaAntarJemput = 5000;
        }



        // 2. Ambil data jasa untuk hitung ulang harga (validasi keamanan)
        $jasa = Jenis_jasa::findOrFail($request->id_jasa);
        $totalHarga = ($jasa->harga * $request->jumlah_barang) + $biayaAntarJemput;



        // 3. Cari dan update data
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'id_user'           => $request->id_user,
            'id_jasa'           => $request->id_jasa,
            'jumlah_barang'     => $request->jumlah_barang,
            'total_harga'       => $totalHarga,
            'description'        => $request->description,
            'status_pembayaran' => $request->status_bayar,
            'tanggal_terima'    => $request->tanggal_terima,
            // Tanggal selesai diperbarui jika status kerja berubah
            'tanggal_selesai'   => ($request->status_kerja == 'Selesai' || $request->status_kerja == 'Diambil')
                ? $transaksi->tanggal_selesai ?? Carbon::now()
                : $request->tanggal_selesai,
            'status_pengerjaan' => $request->status_kerja,
            'antar_jemput'      => $request->antar_jemput ?? false,
            'biaya_antar_jemput' => $biayaAntarJemput,
        ]);

        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Transaksi ' . $transaksi->kode_invoice . ' berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cetak($id)
    {
        $transaksi = Transaksi::with(['user', 'jasa'])->findOrFail($id);
        return view('admin.transaksi.cetak', compact('transaksi'));
    }
}
