<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index() {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create() {
        $permissions = Permission::all(); // Traemos todos los permisos para el checklist
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|unique:roles,name']);
        
        $role = Role::create(['name' => $request->name]);
        
        // Sincronizar los permisos seleccionados
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Rol creado con éxito');
    }

    public function edit(Role $role) {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role) {
        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado');
    }

    public function destroy(Role $role) {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado');
    }
}