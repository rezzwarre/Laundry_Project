<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Transaksi;
use App\Models\Jenis_jasa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. Transaksi Baru Hari Ini
        // Menghitung jumlah transaksi di mana tanggal dibuat = hari ini
        $transaksiHariIni = Transaksi::whereDate('created_at', Carbon::today())->count();

        // 2. Total Jenis Jasa
        // Menghitung total baris di tabel services
        $totalJasa = Jenis_jasa::count();

        // 3. Total Pendapatan Bulan Ini
        // Menjumlahkan kolom 'total_harga' (sesuaikan nama kolom) pada bulan & tahun ini
        $pendapatanBulanIni = Transaksi::whereMonth('created_at', Carbon::now()->month)
                                ->whereYear('created_at', Carbon::now()->year)
                                ->sum('total_harga'); // Ganti 'total_price' dengan nama kolom harga di DB Anda

        // Kirim data ke View
        return view('admin.dashboard', compact('transaksiHariIni', 'totalJasa', 'pendapatanBulanIni'));
        // return view('admin.dashboard');
    }

    public function index()
    {
        $user_admin = Admin::all();
        return view('admin.user_admin.index', compact('user_admin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user_admin.create');
    }

     /**
     * Memproses data registrasi dan menyimpan User baru.
     */
    public function store(Request $request)
    {
        
        //SELESAIKAN INII TUGASSS!!!
        // 1. Validasi Input
        $request->validate([
            'username' => 'required|string|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'nama' => 'required|string|max:255'
        ]);

        // 2. Membuat User baru
        $user = Admin::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama' => $request->nama
        ]);

    

        // 3. Langsung login setelah registrasi (Opsional

        // 4. Redirect ke Dashboard User
        return redirect()->route('admin.user_admin.index')->with('success', 'Data Berhasil Ditambahkan.');
    }

    public function destroy(string $id)
    {
        // 1. Cari data
        $admin = Admin::findOrFail($id);

        // 2. Hapus data
        $admin->delete();

        // 3. Redirect kembali
        return redirect()->route('admin.user_admin.index')
            ->with('success', 'Data berhasil dihapus!');
    }



}
