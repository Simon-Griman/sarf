<?php

namespace App\Http\Controllers;

class ParcelaController extends Controller
{
    public function create($id)
    {
        return view('parcela.create', compact('id'));
    }

    public function show($id)
    {
        return view('parcela.show', compact('id'));
    }
}
