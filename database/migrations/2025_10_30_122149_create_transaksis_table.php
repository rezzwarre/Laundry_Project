<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            
            // 1. Tambahan: Kode Invoice (misal: INV-2025001)
            // Wajib unique agar tidak ada nomor struk ganda
            $table->string('kode_invoice')->unique();

            // Foreign Keys (Perbaikan typo 'foreIgnId' -> 'foreignId')
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_jasa')->constrained('jenis_jasas')->onDelete('cascade');
            
            $table->float('jumlah_barang');
            $table->integer('total_harga');

            $table->string('description')->nullable();

            // 2. Tambahan: Status Pembayaran
            // Penting untuk mengetahui apakah cucian sudah dibayar atau belum (Bon)
            $table->enum('status_pembayaran', ['Belum Lunas', 'Lunas'])->default('Belum Lunas');

            $table->date('tanggal_terima');
            $table->date('tanggal_selesai')->nullable(); // Nullable karena saat terima, belum tentu tahu pasti kapan selesai
            
            $table->enum('status_pengerjaan', ['Menunggu', 'Dijemput', 'Diproses', 'Selesai', 'Diantar', 'Diambil'])
                  ->default('Menunggu');
            
            $table->boolean('antar_jemput')->default(false);

            $table->integer('biaya_antar_jemput')->default(0);


            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
