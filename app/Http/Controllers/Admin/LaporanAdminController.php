<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanAdminController extends Controller
{
    public function index(Request $request)
    {
        // 1. Tentukan Batas Tanggal (Filter)
        $startDate = $request->input('start_date')
            ? Carbon::parse($request->input('start_date'))
            : Carbon::today()->subDays(30); // Default: 30 hari terakhir

        $endDate = $request->input('end_date')
            ? Carbon::parse($request->input('end_date'))->endOfDay()
            : Carbon::now(); // Default: Sampai hari ini

        // Query Utama Transaksi dalam Rentang Tanggal
        $query = Transaksi::with(['user', 'jasa'])
            ->whereBetween('tanggal_terima', [$startDate, $endDate]);

        // 2. Data Ringkasan (Summary Cards)

        // Total Transaksi yang Masuk (Lunas & Belum Lunas)
        $totalOrders = $query->count();

        // Total Pendapatan Bersih (Hanya dari yang sudah LUNAS)
        $totalIncome = (clone $query)->where('status_pembayaran', 'Lunas')->sum('total_harga');

        // Total Piutang (Uang yang Belum Dibayar)
        $totalReceivable = (clone $query)->where('status_pembayaran', 'Belum Lunas')->sum('total_harga');

        // Rata-rata Nilai Pesanan (Average Order Value)
        $averageOrderValue = $totalOrders > 0 ? $totalIncome / $totalOrders : 0;

        // 3. Data Detail Laporan
        $reports = $query->latest()->paginate(20);

        return view('admin.laporan.index', compact(
            'reports',
            'totalOrders',
            'totalIncome',
            'totalReceivable',
            'averageOrderValue',
            'startDate',
            'endDate'
        ));
    }

    // public function generatePdf(Request $request)
    // {
    //     // ... (Logika penentuan $startDate dan $endDate sama) ...
    //     $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::today()->subDays(30);
    //     $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->endOfDay() : Carbon::now();

    //     // 1. Ambil SEMUA data dalam periode
    //     $reports = Transaksi::with(['user', 'jasa'])
    //         ->whereBetween('tanggal_terima', [$startDate, $endDate])
    //         ->get(); // Ambil koleksi

    //     // 2. HITUNG RINGKASAN MENGGUNAKAN KOLEKSI YANG SUDAH DIAMBIL
    //     $totalIncome = $reports->where('status_pembayaran', 'Lunas')->sum('total_harga');
    //     $totalReceivable = $reports->where('status_pembayaran', 'Belum Lunas')->sum('total_harga');
    //     $totalOrders = $reports->count();

    //     // 3. Load View dengan SEMUA VARIABEL RINGKASAN
    //     $pdf = Pdf::loadView('admin.laporan.cetak', compact(
    //         'reports',
    //         'startDate',
    //         'endDate',
    //         'totalIncome', // Kirim variabel yang sudah dihitung
    //         'totalReceivable', // Kirim variabel yang sudah dihitung
    //         'totalOrders' // Kirim variabel yang sudah dihitung
    //     ));

    //     $pdf->setPaper('A4', 'portrait');
    //     return $pdf->download('Laporan-Laundry-' . $startDate->format('Ymd') . '-' . $endDate->format('Ymd') . '.pdf');
    // }

    public function generatePdf(Request $request)
    {
        // MENGAMBIL PARAMETER DARI URL (Query String)
        $startDate = $request->input('start_date')
            ? Carbon::parse($request->input('start_date'))
            : Carbon::today()->subDays(30); // Default jika tidak ada filter

        $endDate = $request->input('end_date')
            ? Carbon::parse($request->input('end_date'))->endOfDay()
            : Carbon::now(); // Default jika tidak ada filter

        // Query hanya mengambil data yang berada di antara periode filter
        $reports = Transaksi::with(['user', 'jasa'])
            ->whereBetween('tanggal_terima', [$startDate, $endDate])
            ->get(); // WAJIB menggunakan get(), bukan paginate()

        // Hitung ringkasan...
        $totalIncome = $reports->where('status_pembayaran', 'Lunas')->sum('total_harga');
        $totalReceivable = $reports->where('status_pembayaran', 'Belum Lunas')->sum('total_harga');
        $totalOrders = $reports->count();

        // Load View dengan data terfilter dan ringkasan
        $pdf = Pdf::loadView('admin.laporan.cetak', compact(
            'reports',
            'startDate',
            'endDate',
            'totalIncome',
            'totalReceivable',
            'totalOrders'
        ));

        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('Laporan-Laundry-' . $startDate->format('Ymd') . '-' . $endDate->format('Ymd') . '.pdf');
    }
}
