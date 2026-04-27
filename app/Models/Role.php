<?php

namespace App\Models;

use App\Traits\TracksCreacion;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use TracksCreacion;

    protected $fillable = [
        'name',
        'guard_name',
        'peso'
    ];
}
