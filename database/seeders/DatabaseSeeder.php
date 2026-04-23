<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(TerminalOrigenSeeder::class);
        $this->call(TerminalDestinoSeeder::class);
        $this->call(OperacionSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ResumenSeeder::class);
        $this->call(UserLoginSeeder::class);
    }
}
