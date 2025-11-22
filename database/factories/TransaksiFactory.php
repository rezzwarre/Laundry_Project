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
        // Ambil data Jasa secara acak (atau buat baru jika kosong)
        $jasa = Jenis_jasa::inRandomOrder()->first() ?? Jenis_jasa::factory()->create();
        
        // Ambil User secara acak
        $user = User::inRandomOrder()->first() ?? User::factory()->create();

        // Random jumlah barang 1-10
        $jumlah = $this->faker->numberBetween(1, 10);

        // Buat tanggal terima acak dalam 7 hari terakhir
        $tanggalTerima = $this->faker->dateTimeBetween('-7 days', 'now');
        
        // Tanggal selesai harus setelah tanggal terima (tambah 1-3 hari dari tgl terima)
        // clone digunakan agar variabel tanggalTerima asli tidak berubah
        $tanggalSelesai = (clone $tanggalTerima)->modify('+' . rand(1, 3) . ' days');

        return [
            // Generate Kode Invoice Unik (Contoh: TRX-839201)
            'kode_invoice'      => 'TRX-' . $this->faker->unique()->numerify('######'),
            
            'id_user'           => $user->id,
            'id_jasa'           => $jasa->id,
            'jumlah_barang'     => $jumlah,
            
            // Kalkulasi otomatis: Harga Satuan x Jumlah
            'total_harga'       => $jumlah * $jasa->harga,
            
            // Kolom baru dari migrasi
            'status_pembayaran' => $this->faker->randomElement(['Belum Lunas', 'Lunas']),
            
            'tanggal_terima'    => $tanggalTerima,
            'tanggal_selesai'   => $tanggalSelesai,
            
            'status_pengerjaan' => $this->faker->randomElement(['Menunggu', 'Diproses', 'Selesai', 'Diambil']),
            
            'created_at'        => $tanggalTerima, // Samakan created_at dengan tanggal terima
            'updated_at'        => now(),
        ];
    }
}
