<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 5; $i++) {
            User::updateOrCreate(
                ['email' => 'petugas'.($i + 1).'@bpbd-bandung.go.id'],
                [
                    'name' => $faker->name(),
                    'password' => Hash::make('Petugas123!'),
                ],
            );
        }

        User::updateOrCreate(
            ['email' => 'admin@bpbd-bandung.go.id'],
            [
                'name' => 'Admin BPBD Kabupaten Bandung',
                'password' => Hash::make('AdminBPBD123!'),
            ],
        );
    }
}
