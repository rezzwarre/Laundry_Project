<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('transaksis')->insert([
            [
                'id_user' => 1,
                'id_jasa' => 1,
                'jumlah_barang' => 5,
                'total_harga' => 5 * 5000,
                'tanggal_terima' => now(),
                'tanggal_selesai' => now()->addDays(1),
                'status_pengerjaan' => 'Diproses',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'id_jasa' => 2,
                'jumlah_barang' => 2,
                'total_harga' => 2 * 10000,
                'tanggal_terima' => now(),
                'tanggal_selesai' => now()->addDays(2),
                'status_pengerjaan' => 'Selesai',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
