<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargos = [
            ['nombre_cargo' => 'Director'],
            ['nombre_cargo' => 'Coordinador'],
            ['nombre_cargo' => 'Programador']
        ];

        foreach ($cargos as $cargo) {
            Cargo::create($cargo);
        }
    }
}
