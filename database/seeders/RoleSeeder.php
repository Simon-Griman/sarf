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
        $rolCintillo = Role::create(['name' => 'cintillo']);

        Permission::create(['name' => 'users.index'])->assignRole([$rolAdmin, $rolUser]);
        Permission::create(['name' => 'users.create'])->assignRole([$rolAdmin, $rolUser]);
        Permission::create(['name' => 'users.edit'])->assignRole([$rolAdmin, $rolUser]);
        Permission::create(['name' => 'users.destroy'])->assignRole([$rolAdmin, $rolUser]);

        Permission::create(['name' => 'roles.index'])->assignRole([$rolAdmin]);
        Permission::create(['name' => 'roles.create'])->assignRole([$rolAdmin]);
        Permission::create(['name' => 'roles.edit'])->assignRole([$rolAdmin]);
        Permission::create(['name' => 'roles.destroy'])->assignRole([$rolAdmin]);

        Permission::create(['name' => 'cintillos.index'])->assignRole([$rolAdmin, $rolCintillo]);
        Permission::create(['name' => 'cintillos.create'])->assignRole([$rolAdmin, $rolCintillo]);
        Permission::create(['name' => 'cintillos.activar'])->assignRole([$rolAdmin, $rolCintillo]);
        Permission::create(['name' => 'cintillos.destroy'])->assignRole([$rolAdmin, $rolCintillo]);
    }
}
