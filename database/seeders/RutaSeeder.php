<?php

namespace Database\Seeders;

use App\Models\Ruta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RutaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ruta::create([
            'buque' => 'Cosita',
            'nro_ruta' => 123456,
            'terminal_origen_id' => 1,
        ])->terminalDestinos()->sync([1, 2]);
    }
}
