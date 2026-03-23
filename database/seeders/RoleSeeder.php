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
        Role::create(['name' => 'super-admin', 'peso' => 10]);
        $rolAdmin = Role::create(['name' => 'admin', 'peso' => 5]);
        $rolUser = Role::create(['name' => 'user', 'peso' => 3]);
        $rolCintillo = Role::create(['name' => 'cintillo', 'peso' => 2]);
        $rolResumen = Role::create(['name' => 'resumen', 'peso' => 1]);

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

        Permission::create(['name' => 'resumen.index'])->assignRole([$rolAdmin, $rolResumen]);
        Permission::create(['name' => 'resumen.create'])->assignRole([$rolAdmin, $rolResumen]);
        Permission::create(['name' => 'resumen.edit'])->assignRole([$rolAdmin, $rolResumen]);
        Permission::create(['name' => 'resumen.destroy'])->assignRole([$rolAdmin, $rolResumen]);
    }
}
