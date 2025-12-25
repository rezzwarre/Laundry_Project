<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jenis_jasa;

class Jenis_jasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis_jasas = Jenis_jasa::all();
        return view('admin.jenis_jasa.index', compact('jenis_jasas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jenis_jasa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_jasa' => 'required|string|max:255',
            'jenis_barang' => 'required|string|max:255',
            'kategori' => 'required|in:jumlah,berat',
            'harga' => 'required|integer|min:0',
        ]);

        Jenis_jasa::create($validatedData);
        return redirect()->route('admin.jenis_jasa.index')->with('success', 'Jenis Jasa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // 1. Cari data berdasarkan ID, jika tidak ada tampilkan error 404
        $jenis_jasa = Jenis_jasa::findOrFail($id);

        // 2. Tampilkan view edit dan kirim datanya
        return view('admin.jenis_jasa.edit', compact('jenis_jasa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Validasi input (sama seperti store)
        $request->validate([
            'jenis_jasa'   => 'required|string|max:255',
            'jenis_barang' => 'required|string|max:255',
            'kategori' => 'required|in:jumlah,berat',
            'harga'        => 'required|numeric|min:0',
        ]);

        // 2. Cari data yang akan diupdate
        $jenis_jasa = Jenis_jasa::findOrFail($id);

        // 3. Update data
        $jenis_jasa->update([
            'jenis_jasa'   => $request->jenis_jasa,
            'jenis_barang' => $request->jenis_barang,
            'kategori' => $request->kategori,
            'harga'        => $request->harga,
        ]);

        // 4. Redirect kembali
        return redirect()->route('admin.jenis_jasa.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. Cari data
        $jenis_jasa = Jenis_jasa::findOrFail($id);

        // 2. Hapus data
        $jenis_jasa->delete();

        // 3. Redirect kembali
        return redirect()->route('admin.jenis_jasa.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
