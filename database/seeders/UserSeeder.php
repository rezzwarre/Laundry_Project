<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'reza',
                'password' => Hash::make('123456'),
                'nama' => 'Reza Adriansyah',
                'alamat' => 'Jl. Merdeka No. 10',
                'no_hp' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'dina',
                'password' => Hash::make('123456'),
                'nama' => 'Dina Lestari',
                'alamat' => 'Jl. Mawar No. 5',
                'no_hp' => '082233445566',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
