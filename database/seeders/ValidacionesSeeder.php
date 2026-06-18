<?php

namespace Database\Seeders;

use App\Models\FormField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ValidacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FormField::create(['field_name' => 'terminal_origen']);
        FormField::create(['field_name' => 'terminal_destino']);
        FormField::create(['field_name' => 'buque']);
        FormField::create(['field_name' => 'fecha_operacion']);
        FormField::create(['field_name' => 'inspector']);
        FormField::create(['field_name' => 'cantidad_determinada']);
        FormField::create(['field_name' => 'nominacion']);
        FormField::create(['field_name' => 'embarque']);
        FormField::create(['field_name' => 'cantidad']);
        FormField::create(['field_name' => 'calidad']);
        FormField::create(['field_name' => 'hoja_tiempo']);
        FormField::create(['field_name' => 'acta']);
        FormField::create(['field_name' => 'ullage_inicial']);
        FormField::create(['field_name' => 'ullage_final']);
        FormField::create(['field_name' => 'producto']);
        FormField::create(['field_name' => 'volumen']);
    }
}
