<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producto::create(['nombre' => 'Gasolina 91']);
        Producto::create(['nombre' => 'Gasoil']);
        Producto::create(['nombre' => 'Diesel Marino']);
        Producto::create(['nombre' => 'Ifo 380']);
        Producto::create(['nombre' => 'Fuel Oil']);
        Producto::create(['nombre' => 'Jet A1']);
        Producto::create(['nombre' => 'Solventes']);
        Producto::create(['nombre' => 'Asfalto']);
        Producto::create(['nombre' => 'Negro de Humo']);
        Producto::create(['nombre' => 'Crudo']);
        Producto::create(['nombre' => 'Lubricantes']);
        Producto::create(['nombre' => 'Condensado']);
        Producto::create(['nombre' => 'Alquitran']);
    }
}
