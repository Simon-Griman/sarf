<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CintilloController extends Controller
{
    public function __invoke()
    {
        return view('cintillos');
    }
}
