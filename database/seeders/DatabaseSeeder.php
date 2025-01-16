<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\Nivel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CargoSeeder::class,
            NivelSeeder::class
        ]);
    }
}
