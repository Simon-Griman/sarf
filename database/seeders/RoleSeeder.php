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
        $rolCargamento = Role::create(['name' => 'cargamento', 'peso' => 1]);
        $rolAuditoria = Role::create(['name' => 'auditoria', 'peso' => 1]);
        $rolConfiguracion = Role::create(['name' => 'configuracion', 'peso' => 2]);

        Permission::create(['name' => 'users.index'])->assignRole([$rolAdmin, $rolUser]);
        Permission::create(['name' => 'users.create'])->assignRole([$rolAdmin, $rolUser]);
        Permission::create(['name' => 'users.edit'])->assignRole([$rolAdmin, $rolUser]);
        Permission::create(['name' => 'users.destroy'])->assignRole([$rolAdmin, $rolUser]);

        Permission::create(['name' => 'roles.index'])->assignRole([$rolAdmin]);
        Permission::create(['name' => 'roles.create'])->assignRole([$rolAdmin]);
        Permission::create(['name' => 'roles.edit'])->assignRole([$rolAdmin]);
        Permission::create(['name' => 'roles.destroy'])->assignRole([$rolAdmin]);

        Permission::create(['name' => 'cintillos.index'])->assignRole([$rolAdmin, $rolConfiguracion]);
        Permission::create(['name' => 'cintillos.create'])->assignRole([$rolAdmin, $rolConfiguracion]);
        Permission::create(['name' => 'cintillos.activar'])->assignRole([$rolAdmin, $rolConfiguracion]);
        Permission::create(['name' => 'cintillos.destroy'])->assignRole([$rolAdmin, $rolConfiguracion]);

        Permission::create(['name' => 'cargamento.index'])->assignRole([$rolAdmin, $rolCargamento]);
        Permission::create(['name' => 'cargamento.create'])->assignRole([$rolAdmin, $rolCargamento]);
        Permission::create(['name' => 'cargamento.edit'])->assignRole([$rolAdmin, $rolCargamento]);
        Permission::create(['name' => 'cargamento.destroy'])->assignRole([$rolAdmin, $rolCargamento]);

        Permission::create(['name' => 'parcela.add'])->assignRole([$rolAdmin, $rolCargamento]);
        Permission::create(['name' => 'parcela.view'])->assignRole([$rolAdmin, $rolCargamento]);
        Permission::create(['name' => 'parcela.edit'])->assignRole([$rolAdmin, $rolCargamento]);
        Permission::create(['name' => 'parcela.resumen'])->assignRole([$rolAdmin, $rolCargamento]);
        Permission::create(['name' => 'parcela.destroy'])->assignRole([$rolAdmin, $rolCargamento]);

        Permission::create(['name' => 'auditoria.sesiones'])->assignRole([$rolAdmin, $rolAuditoria]);
        Permission::create(['name' => 'auditoria.creados'])->assignRole([$rolAdmin, $rolAuditoria]);
        Permission::create(['name' => 'auditoria.editados'])->assignRole([$rolAdmin, $rolAuditoria]);
        Permission::create(['name' => 'auditoria.eliminados'])->assignRole([$rolAdmin, $rolAuditoria]);

        Permission::create(['name' => 'terminal.origen'])->assignRole([$rolAdmin, $rolConfiguracion]);
        Permission::create(['name' => 'terminal.destino'])->assignRole([$rolAdmin, $rolConfiguracion]);

        Permission::create(['name' => 'producto'])->assignRole([$rolAdmin, $rolConfiguracion]);

        Permission::create(['name' => 'reset-pass'])->assignRole([$rolAdmin]);

        Permission::create(['name' => 'validaciones'])->assignRole([$rolAdmin, $rolConfiguracion]);
    }
}
