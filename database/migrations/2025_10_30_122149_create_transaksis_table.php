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
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreIgnId('id_jasa')->constrained('jenis_jasas')->onDelete('cascade');
            $table->integer('jumlah_barang');
            $table->integer('total_harga');
            $table->date('tanggal_terima');
            $table->date('tanggal_selesai')->nullable();
            $table->enum('status_pengerjaan', ['Menunggu', 'Diproses', 'Selesai', 'Diambil'])->default('Menunggu');
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
