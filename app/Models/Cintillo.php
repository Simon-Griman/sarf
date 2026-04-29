<?php

namespace App\Models;

use App\Traits\TracksCreacion;
use App\Traits\TracksEdicion;
use Illuminate\Database\Eloquent\Model;

class Cintillo extends Model
{
    use TracksCreacion, TracksEdicion;

    protected $fillable = [
        'nombre',
        'activo',
        'modo',
    ];
}
