<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cargamento>
 */
class CargamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $operacion = \App\Models\Operacion::select('id', 'nombre')->get();
        $inspector = \App\Models\Inspector::pluck('id');
        $ruta = \App\Models\Ruta::pluck('id');

        $operacion_id = fake()->randomElement($operacion);

        return [
            'nro_embarque' => fake()->numberBetween(100000000000, 999999999999),
            'fecha_operacion' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'ruta_id' => fake()->randomElement($ruta),
            'operacion_id' => $operacion_id->id,
            'inspector_id' => fake()->randomElement($inspector),
            'cantidad_determinada' => fake()->randomElement(['Tanque de Tierra', 'Cifras Buque']),
        ];
    }
}
