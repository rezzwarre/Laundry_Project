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
        Schema::create('jenis_jasas', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_jasa');
            $table->string('jenis_barang');
            $table->integer('harga');
            $table->enum('kategori', ['jumlah', 'berat'])->default('jumlah'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_jasas');
    }
};
