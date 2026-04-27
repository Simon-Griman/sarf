<?php

namespace App\Models;

use App\Traits\TracksCreacion;
use Illuminate\Database\Eloquent\Model;

class Cintillo extends Model
{
    use TracksCreacion;

    protected $fillable = [
        'nombre',
        'activo',
        'modo',
    ];
}
