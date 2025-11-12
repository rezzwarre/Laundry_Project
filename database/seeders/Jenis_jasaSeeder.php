<?php

namespace Database\Seeders;

use App\Models\Jenis_jasa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Jenis_jasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_jasas')->insert([
            [
                'jenis_jasa' => 'Cuci Kering',
                'jenis_barang' => 'Baju',
                'harga' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis_jasa' => 'Cuci Setrika',
                'jenis_barang' => 'Selimut',
                'harga' => 10000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis_jasa' => 'Setrika Saja',
                'jenis_barang' => 'Celana',
                'harga' => 3000,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);




        // $fakultsas = [
        //     ['jenis_jasa' => 'Cucian', 'jenis_barang' => 'Baju', 'harga' => 5000],
        //     ['jenis_jasa' => 'Pengeringan', 'jenis_barang' => 'Celana', 'harga' => 6000]

        // ];

        // foreach($fakultsas as $item){
        //     Jenis_jasa::create($item);
        // }
    }
}
