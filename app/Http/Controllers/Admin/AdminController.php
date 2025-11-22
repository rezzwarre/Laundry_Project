<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jenis_jasa;

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
}
