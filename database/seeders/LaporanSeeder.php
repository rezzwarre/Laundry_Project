<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('laporans')->insert([
            [
                'id_transaksi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_transaksi' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
