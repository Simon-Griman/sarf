<?php

namespace App\Models;

use App\Traits\TracksCreacion;
use App\Traits\TracksEdicion;
use App\Traits\TracksEliminacion;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use TracksCreacion, TracksEdicion, TracksEliminacion;

    protected $fillable = [
        'name',
        'guard_name',
        'peso'
    ];
}
