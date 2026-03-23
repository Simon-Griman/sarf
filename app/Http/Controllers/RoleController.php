<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:roles.create', only: ['create']),
            
            new Middleware('permission:roles.index', only: ['index']),

            new Middleware('permission:roles.edit', only: ['edit']),
        ];
    }

    public function index() {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create() {
        $permissions = Permission::all(); // Traemos todos los permisos para el checklist
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request) {
        
        $peso = auth()->user()->roles->max('peso') ?? 0;

        $request->validate([
            'name' => 'required|unique:roles,name',
            'peso' => 'nullable|integer|max:'.$peso,
        ]);
        
        $role = Role::create([
            'name' => $request->name,
            'peso' => $request->peso,
        ]);
        
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

        $peso = auth()->user()->roles->max('peso') ?? 0;

        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'peso' => 'nullable|integer|max:'.$peso,
        ]);
        
        $role->update([
            'name' => $request->name,
            'peso' => $request->peso,
        ]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado');
    }

    public function destroy(Role $role) {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado');
    }
}