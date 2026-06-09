<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CargamentoController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:cargamento.create', only: ['create']),
            
            new Middleware('permission:cargamento.index', only: ['index']),

            new Middleware('permission:cargamento.edit', only: ['edit']),
        ];
    }

    public function index()
    {
        return view('cargamento.index');
    }

    public function create()
    {
        return view('cargamento.create');
    }

    public function edit($id)
    {
        return view('cargamento.edit', compact('id'));
    }
}
