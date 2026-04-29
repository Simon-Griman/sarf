<?php

namespace App\Models;

use App\Traits\TracksCreacion;
use App\Traits\TracksEdicion;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use TracksCreacion, TracksEdicion;

    protected $fillable = [
        'name',
        'guard_name',
        'peso'
    ];
}
