<?php

namespace Database\Seeders;

use App\Models\TerminalDestino;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TerminalDestinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TerminalDestino::factory()->count(50)->create();
    }
}
