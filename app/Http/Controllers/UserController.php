<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // Aplica el permiso 'users.create' solo al método 'create'
            new Middleware('permission:users.create', only: ['create']),
            
            // Ejemplo para index
            new Middleware('permission:users.index', only: ['index']),

            new Middleware('permission:users.edit', only: ['edit']),
        ];
    }

    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function edit($id)
    {
        return view('users.edit', compact('id'));
    }

    public function update()
    {
        
    }
}
