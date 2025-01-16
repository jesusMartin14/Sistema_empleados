<?php

namespace Database\Seeders;

use App\Models\Nivel;
use Illuminate\Database\Seeder;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $niveles = [
            ['salario' => 50000],
            ['salario' => 25000],
            ['salario' => 12500]
        ];

        foreach ($niveles as $nivel) {
            Nivel::create($nivel);
        }
    }
}
