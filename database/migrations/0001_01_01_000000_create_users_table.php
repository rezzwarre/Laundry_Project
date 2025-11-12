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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // kolom id auto increment
            $table->string('username', 50)->unique(); // username unik
            $table->string('password'); // password
            $table->string('nama', 100); // nama lengkap
            $table->string('alamat', 255)->nullable(); // alamat bisa kosong
            $table->string('no_hp', 15)->nullable(); // nomor hp bisa kosong
            $table->timestamps(); // otomatis membuat created_at dan updated_at
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        
    }
};
