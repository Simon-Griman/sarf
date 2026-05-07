<?php

namespace App\Models;

use App\Traits\TracksCreacion;
use App\Traits\TracksEdicion;
use App\Traits\TracksEliminacion;
use Illuminate\Database\Eloquent\Model;

class Cintillo extends Model
{
    use TracksCreacion, TracksEdicion, TracksEliminacion;

    protected $fillable = [
        'nombre',
        'activo',
        'modo',
    ];
}
