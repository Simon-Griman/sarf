<?php

namespace Database\Seeders;

use App\Models\TerminalOrigen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sede = TerminalOrigen::where('nombre', 'Sede')->first();

        $sede->users()->create([
            'name' => 'Simón Grimán',
            'email' => 'simongrimanv@hotmail.com',
            'cedula' => 26716044,
            'password' => Hash::make('simonG20'),
        ]);
    }
}
