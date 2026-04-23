<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserLogin>
 */
class UserLoginFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'ip_address' => fake()->ipv4(),
            'sistema' => 'Windows 10 en Escritorio',
            'navegador' => 'Google Chrome',
            'login_at' => fake()->dateTime(),
        ];
    }
}
