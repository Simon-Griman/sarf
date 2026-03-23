<?php

namespace App\Http\Controllers;

use App\Models\Resumen;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ResumenController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:resumen.create', only: ['create']),
            
            new Middleware('permission:resumen.index', only: ['index']),

            new Middleware('permission:resumen.edit', only: ['edit']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('resumen.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $operacion = $request->query('operacion'); // Obtener el valor de 'operacion' desde la URL

        return view('resumen.create', compact('operacion')); // Pasar 'operacion' a la vista
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('resumen.edit', compact('id'));
    }
}
