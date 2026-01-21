<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Laporan;
use App\Models\Transaksi;
use App\Models\Jenis_jasa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            // UserSeeder::class,
            AdminSeeder::class,
            Jenis_jasaSeeder::class,
            // TransaksiSeeder::class,
            // LaporanSeeder::class,
            

        ]);


        User::factory(20)->create();
        // Admin::factory(2)->create();

        // Jenis_jasa::factory(5)->create();

        Transaksi::factory(50)->create();

        Laporan::factory(30)->create();
    }
}
