<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resumen>
 */
class ResumenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $terminalOrigen = \App\Models\TerminalOrigen::pluck('id');
        $terminalDestino = \App\Models\TerminalDestino::pluck('id');
        $operacion = \App\Models\Operacion::select('id', 'nombre')->get();
        $producto = \App\Models\Producto::pluck('id');

        $operacion_id = fake()->randomElement($operacion);

        if ($operacion_id->nombre == 'Carga' || $operacion_id->nombre == 'Importación')
        {
            $carga = true;
        }

        elseif ($operacion_id->nombre == 'Descarga' || $operacion_id->nombre == 'Exportación')
        {
            $carga = false;
        }

        return [
            'terminal_origen_id' => fake()->randomElement($terminalOrigen),
            'terminal_destino_id' => fake()->randomElement($terminalDestino),
            'buque' => fake()->name(),
            'nro_embarque' => fake()->numberBetween(100000000000, 999999999999),
            'nro_viaje' => fake()->unique()->numberBetween(10000, 99999),
            'operacion_id' => $operacion_id->id,
            'producto_id' => fake()->randomElement($producto),
            'volumen' => fake()->numberBetween(100000, 999999),
            'inspector' => 'SAMH',
            'cantidad_determinada' => fake()->randomElement(['Tanque de Tierra', 'Cifras Buque']),
            'documento' => fake()->randomElement(['Borrador', 'Definitivo']),
            'TOV' => fake()->randomFloat(2, 100000, 999999.99),
            'GOV' => fake()->randomFloat(2, 100000, 999999.99),
            'GSV' => fake()->randomFloat(2, 100000, 999999.99),
            'NSV' => fake()->randomFloat(2, 100000, 999999.99),
            'TCV' => fake()->randomFloat(2, 100000, 999999.99),
            'sediment_water' => fake()->randomFloat(2, 100, 999.99),
            'free_water' => fake()->randomFloat(2, 100, 999.99),
            'tabla_VCF' => strtoupper(fake()->bothify('?#')),
            'temp' => fake()->numberBetween(10, 100),
            'API' => fake()->numberBetween(10, 100),

            //carga
            'OBQ' => $carga ? fake()->numberBetween(0, 10) : null,
            'OBQ_agua' => $carga ? fake()->numberBetween(0, 10) : null,
            'TCV_carga' => $carga ? fake()->numberBetween(100000, 999999) : null,
            'GSV_carga' => $carga ? fake()->numberBetween(100000, 999999) : null,
            'NSV_carga' => $carga ? fake()->numberBetween(100000, 999999) : null,
            'TRV' => $carga ? fake()->numberBetween(100000, 999999) : null,
            'TRV_ajustado' => $carga ? fake()->numberBetween(100000, 999999) : null,

            //descarga
            'ROB' => !$carga ? fake()->numberBetween(0, 10) : null,
            'ROB_agua' => !$carga ? fake()->numberBetween(0, 10) : null,
            'TCV_descarga' => !$carga ? fake()->numberBetween(100000, 999999) : null,
            'GSV_descarga' => !$carga ? fake()->numberBetween(100000, 999999) : null,
            'NSV_descarga' => !$carga ? fake()->numberBetween(100000, 999999) : null,
            'TDV' => !$carga ? fake()->numberBetween(100000, 999999) : null,
            'TDV_ajustado' => !$carga ? fake()->numberBetween(100000, 999999) : null,

            'VEF' => fake()->numberBetween(0, 9),
        ];
    }
}
