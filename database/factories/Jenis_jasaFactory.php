<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jenis_jasa>
 */
class Jenis_jasaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenis = $this->faker->randomElement(['Cuci Kering', 'Cuci Setrika', 'Setrika Saja']);
        $barang = $this->faker->randomElement(['Baju', 'Celana', 'Selimut', 'Karpet', 'Jaket']);

        return [
            'jenis_jasa' => $jenis,
            'jenis_barang' => $barang,
            'harga' => $this->faker->numberBetween(3000, 15000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
