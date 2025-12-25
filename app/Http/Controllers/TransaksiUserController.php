<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Transaksi;
use App\Models\Jenis_jasa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TransaksiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $transaksis = Transaksi::where('id_user', Auth::id())->get();
        return view('user.transaksi.index', compact('transaksis'));


        // $transaksis = Transaksi::where('id_user', Auth::id())->latest()->get();
        // return view('user.transaksi.index', compact('transaksis'));

        // $transaksis = Transaksi::where('id_user', Auth::id())->get();
        // dd($transaksis); // Ini akan menghentikan aplikasi dan menampilkan isi data
        // return view('user.transaksi.index', compact('transaksis'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis_jasas = Jenis_jasa::all();
        return view('user.transaksi.create', compact('jenis_jasas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        // 1. Validasi Input
        // Jumlah/Berat dan Total Tagihan DIHILANGKAN dari validasi karena diisi Admin
        // dd($request->id_jasa);

        $validatedData = $request->validate([
            'id_jasa' => 'required|exists:jenis_jasas,id',
            'description' => 'required|string|max:500', // Kolom catatan baru
        ]);
        // dd($request->id_jasa);

        try {
            DB::beginTransaction();


            // Generate Kode Transaksi unik (Contoh: TR-Tahun-Bulan-ID)
            // $lastId = Transaksi::max('id') ?? 0;
            // $kode = 'TR-' . date('Ym') . '-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
            $kode = 'INV-' . Carbon::now()->format('Ymd') . '-' . strtoupper(Str::random(3));

            // 2. Buat Transaksi Baru
            Transaksi::create([
                'kode_invoice' => $kode,
                'id_user' => Auth::user()->id,
                'id_jasa' => $validatedData['id_jasa'],
                'description' => $validatedData['description'] ?? null,


                // Nilai default yang akan diisi Admin
                'jumlah_barang' => 0.0, // Default 0
                'total_harga' => 0, // Default 0
                'tanggal_terima' => now(), // Tanggal pembuatan

                // Status Awal
                'status_pengerjaan' => 'Menunggu',
                'status_bayar' => 'Belum Lunas',

            ]);


            DB::commit();

            return redirect()->route('user.dashboard')->with('success', 'Pesanan laundry berhasil dibuat. Menunggu verifikasi dari Admin.');
        } catch (\Exception $e) {
            DB::rollBack();
            // Log error atau tampilkan pesan yang ramah
            // throw ValidationException::withMessages(['error' => 'Gagal menyimpan transaksi. Silakan coba lagi.']);
            dd($e->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        if ($transaksi->id_user !== Auth::id()) {
            abort(403);
        }
        return view('user.transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
