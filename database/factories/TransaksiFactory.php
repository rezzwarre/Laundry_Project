<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Jenis_jasa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jasa = Jenis_jasa::inRandomOrder()->first() ?? Jenis_jasa::factory()->create();
        $jumlah = $this->faker->numberBetween(1, 10);
        return [
            'id_user' => User::inRandomOrder()->first()->id ?? User::factory(),
            'id_jasa' => $jasa->id,
            'jumlah_barang' => $jumlah,
            'total_harga' => $jumlah * $jasa->harga,
            'tanggal_terima' => $this->faker->dateTimeBetween('-7 days', 'now'),
            'tanggal_selesai' => $this->faker->dateTimeBetween('now', '+3 days'),
            'status_pengerjaan' => $this->faker->randomElement(['Menunggu', 'Diproses', 'Selesai', 'Diambil']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
