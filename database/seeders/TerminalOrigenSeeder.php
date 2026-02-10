<?php

namespace Database\Seeders;

use App\Models\TerminalOrigen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TerminalOrigenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TerminalOrigen::create([
            'nombre' => 'Sede',
        ]);

        TerminalOrigen::factory()->count(99)->create();
    }
}
