<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Jenis_jasa;
use Illuminate\Support\Facades\Auth;

class TransaksiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::where('id_user', Auth::id())->latest()->get();
        return view('user.transaksi.index', compact('transaksis'));
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
        $transaksi = new Transaksi;
        $transaksi->id_user = Auth::id();
        // ... (isi kolom lain) ...
        $transaksi->tanggal_terima = now();
        $transaksi->status_pengerjaan = 'Diterima';
        $transaksi->save();
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
