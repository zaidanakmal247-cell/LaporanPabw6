<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'petugas@parktrack.test'],
            ['name' => 'Petugas ParkTrack', 'password' => 'password']
        );

        User::factory()->count(5)->create();
    }
}
