<?php

namespace Database\Seeders;

use App\Models\Operacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OperacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Operacion::create(['nombre' => 'Carga']);
        Operacion::create(['nombre' => 'Descarga']);
        Operacion::create(['nombre' => 'Importación']);
        Operacion::create(['nombre' => 'Exportación']);
    }
}
