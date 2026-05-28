<?php

namespace App\Http\Controllers;

class CargamentoController extends Controller
{
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
