<?php

namespace Database\Seeders;

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
        //php artisan db:seed --class=RoleSeeder

        Role::firstOrCreate(['name' => 'super-admin', 'peso' => 10]);
        $rolAdmin = Role::firstOrCreate(['name' => 'admin', 'peso' => 5]);
        $rolUser = Role::firstOrCreate(['name' => 'user', 'peso' => 3]);
        $rolCargamento = Role::firstOrCreate(['name' => 'cargamento', 'peso' => 1]);
        $rolAuditoria = Role::firstOrCreate(['name' => 'auditoria', 'peso' => 1]);
        $rolConfiguracion = Role::firstOrCreate(['name' => 'configuracion', 'peso' => 2]);

        Permission::firstOrCreate(['name' => 'users.index'])->assignRole([$rolAdmin, $rolUser]);
        Permission::firstOrCreate(['name' => 'users.create'])->assignRole([$rolAdmin, $rolUser]);
        Permission::firstOrCreate(['name' => 'users.edit'])->assignRole([$rolAdmin, $rolUser]);
        Permission::firstOrCreate(['name' => 'users.destroy'])->assignRole([$rolAdmin, $rolUser]);

        Permission::firstOrCreate(['name' => 'roles.index'])->assignRole([$rolAdmin]);
        Permission::firstOrCreate(['name' => 'roles.create'])->assignRole([$rolAdmin]);
        Permission::firstOrCreate(['name' => 'roles.edit'])->assignRole([$rolAdmin]);
        Permission::firstOrCreate(['name' => 'roles.destroy'])->assignRole([$rolAdmin]);

        Permission::firstOrCreate(['name' => 'cintillos.index'])->assignRole([$rolAdmin, $rolConfiguracion]);
        Permission::firstOrCreate(['name' => 'cintillos.create'])->assignRole([$rolAdmin, $rolConfiguracion]);
        Permission::firstOrCreate(['name' => 'cintillos.activar'])->assignRole([$rolAdmin, $rolConfiguracion]);
        Permission::firstOrCreate(['name' => 'cintillos.destroy'])->assignRole([$rolAdmin, $rolConfiguracion]);

        Permission::firstOrCreate(['name' => 'cargamento.index'])->assignRole([$rolAdmin, $rolCargamento]);
        Permission::firstOrCreate(['name' => 'cargamento.create'])->assignRole([$rolAdmin, $rolCargamento]);
        Permission::firstOrCreate(['name' => 'cargamento.edit'])->assignRole([$rolAdmin, $rolCargamento]);
        Permission::firstOrCreate(['name' => 'cargamento.destroy'])->assignRole([$rolAdmin, $rolCargamento]);

        Permission::firstOrCreate(['name' => 'ruta.index'])->assignRole([$rolAdmin, $rolCargamento]);
        Permission::firstOrCreate(['name' => 'ruta.create'])->assignRole([$rolAdmin, $rolCargamento]);
        Permission::firstOrCreate(['name' => 'ruta.edit'])->assignRole([$rolAdmin, $rolCargamento]);
        Permission::firstOrCreate(['name' => 'ruta.destroy'])->assignRole([$rolAdmin, $rolCargamento]);
        Permission::firstOrCreate(['name' => 'ruta.view'])->assignRole([$rolAdmin, $rolCargamento]);

        Permission::firstOrCreate(['name' => 'parcela.add'])->assignRole([$rolAdmin, $rolCargamento]);
        Permission::firstOrCreate(['name' => 'parcela.view'])->assignRole([$rolAdmin, $rolCargamento]);
        Permission::firstOrCreate(['name' => 'parcela.edit'])->assignRole([$rolAdmin, $rolCargamento]);
        Permission::firstOrCreate(['name' => 'parcela.resumen'])->assignRole([$rolAdmin, $rolCargamento]);
        Permission::firstOrCreate(['name' => 'parcela.destroy'])->assignRole([$rolAdmin, $rolCargamento]);

        Permission::firstOrCreate(['name' => 'auditoria.sesiones'])->assignRole([$rolAdmin, $rolAuditoria]);
        Permission::firstOrCreate(['name' => 'auditoria.creados'])->assignRole([$rolAdmin, $rolAuditoria]);
        Permission::firstOrCreate(['name' => 'auditoria.editados'])->assignRole([$rolAdmin, $rolAuditoria]);
        Permission::firstOrCreate(['name' => 'auditoria.eliminados'])->assignRole([$rolAdmin, $rolAuditoria]);

        Permission::firstOrCreate(['name' => 'terminal.origen'])->assignRole([$rolAdmin, $rolConfiguracion]);
        Permission::firstOrCreate(['name' => 'terminal.destino'])->assignRole([$rolAdmin, $rolConfiguracion]);

        Permission::firstOrCreate(['name' => 'producto'])->assignRole([$rolAdmin, $rolConfiguracion]);

        Permission::firstOrCreate(['name' => 'reset-pass'])->assignRole([$rolAdmin]);

        Permission::firstOrCreate(['name' => 'validaciones'])->assignRole([$rolAdmin, $rolConfiguracion]);
    }
}
