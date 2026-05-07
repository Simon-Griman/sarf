<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RespaldoBorrados extends Model
{
    protected $fillable = [
        'role_id',
        'role',
        'peso',
        'deleted_at'
    ];
}
