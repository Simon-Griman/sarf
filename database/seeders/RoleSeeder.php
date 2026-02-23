<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'super-admin']);
        $rolAdmin = Role::create(['name' => 'admin']);
        $rolUser = Role::create(['name' => 'user']);

        Permission::create(['name' => 'users.index'])->assignRole([$rolAdmin, $rolUser]);
        Permission::create(['name' => 'users.create'])->assignRole([$rolAdmin, $rolUser]);
        Permission::create(['name' => 'users.edit'])->assignRole([$rolAdmin, $rolUser]);
        Permission::create(['name' => 'users.destroy'])->assignRole([$rolAdmin, $rolUser]);
    }
}
