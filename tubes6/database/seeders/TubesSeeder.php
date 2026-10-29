<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Reservasi;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TubesSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 1. Buat Data Kategori
        $katVIP = Kategori::create([
            'nama_kategori' => 'Parkir VIP',
            'deskripsi'     => 'Area parkir dekat pintu masuk dengan pengawasan CCTV 24 jam.'
        ]);

        $katReguler = Kategori::create([
            'nama_kategori' => 'Parkir Reguler',
            'deskripsi'     => 'Area parkir umum standar gedung.'
        ]);

        $kategoriIds = [$katVIP->id, $katReguler->id];

        // 2. Buat Minimal 10 Data Dummy Reservasi
        for ($i = 0; $i < 10; $i++) {
            Reservasi::create([
                'kategori_id'       => $faker->randomElement($kategoriIds),
                'nama_pengguna'     => $faker->name,
                'nomor_plat'        => 'D ' . $faker->numberBetween(1000, 9999) . ' ' . strtoupper($faker->lexify('??')),
                'tanggal_reservasi' => $faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
                'durasi_jam'        => $faker->numberBetween(1, 12),
                'status'            => $faker->randomElement(['pending', 'disetujui', 'selesai']),
            ]);
        }
    }
}