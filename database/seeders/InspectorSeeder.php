<?php

namespace Database\Seeders;

use App\Models\Inspector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InspectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inspector::create(['nombre' => 'SAMH']);
        Inspector::create(['nombre' => 'IC Global']);
        Inspector::create(['nombre' => 'Amspec']);
        Inspector::create(['nombre' => 'AIVEPET']);
        Inspector::create(['nombre' => 'Atlas Marine']);
    }
}
