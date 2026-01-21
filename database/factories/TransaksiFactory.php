<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Jenis_jasa;
use Illuminate\Database\Eloquent\Factories\Factory;


class TransaksiFactory extends Factory
{

    public function definition(): array
    {
        $jasa = Jenis_jasa::inRandomOrder()->first()
            ?? Jenis_jasa::factory()->create();

        // 🔹 Tentukan sumber transaksi
        $isOnline = $this->faker->boolean(70); // 70% online, 30% kasir

        $user = null;
        $namaPelanggan = null;
        $noHp = null;

        if ($isOnline) {
            $user = User::inRandomOrder()->first()
                ?? User::factory()->create();
        } else {
            $namaPelanggan = $this->faker->name();
            $noHp = $this->faker->phoneNumber();
        }

        // Jumlah barang / berat
        $jumlah = $jasa->kategori === 'berat'
            ? $this->faker->randomFloat(1, 1, 5)
            : $this->faker->numberBetween(1, 10);

        // Status pengerjaan
        $statusKerja = $this->faker->randomElement([
            'Menunggu',
            'Diproses',
            'Selesai',
            'Diambil',
        ]);

        // Antar jemput
        $antarJemput = $this->faker->boolean(40);

        // 🔥 LOGIKA BIAYA ANTAR JEMPUT
        $biayaAntarJemput = 0;
        if ($antarJemput && !in_array($statusKerja, ['Menunggu'])) {
            $biayaAntarJemput = 5000;
        }

        // Tanggal
        $tanggalTerima = $this->faker->dateTimeBetween('-14 days', 'now');
        $tanggalSelesai = in_array($statusKerja, ['Selesai', 'Diambil'])
            ? (clone $tanggalTerima)->modify('+' . rand(1, 3) . ' days')
            : null;

        // Total harga
        $totalHarga = ($jumlah * $jasa->harga) + $biayaAntarJemput;

        return [
            'kode_invoice' => 'INV-' . $this->faker->unique()->numerify('######'),

            // ONLINE vs KASIR
            'id_user'       => $user?->id,
            'nama_pelanggan'=> $namaPelanggan,
            'no_hp_pelanggan' => $noHp,

            'id_jasa'       => $jasa->id,
            'jumlah_barang' => $jumlah,
            'description'   => $this->faker->sentence(),

            'antar_jemput'        => $antarJemput,
            'biaya_antar_jemput' => $biayaAntarJemput,

            'total_harga'       => $totalHarga,
            'status_pembayaran' => $this->faker->randomElement(['Belum Lunas', 'Lunas']),
            'status_pengerjaan' => $statusKerja,

            'tanggal_terima'  => $tanggalTerima,
            'tanggal_selesai' => $tanggalSelesai,

            'created_at' => $tanggalTerima,
            'updated_at' => now(),
        ];
    }
}
