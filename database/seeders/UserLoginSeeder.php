<?php

namespace Database\Seeders;

use App\Models\UserLogin;
use Illuminate\Database\Seeder;

class UserLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserLogin::factory()->count(250)->create();
    }
}
