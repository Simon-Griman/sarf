<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RespaldoEditados extends Model
{
    protected $fillable = [
        'resumen_id',
        'user_id',
        'cintillo_id',
        'role_id',
        'campo',
        'valor_antes',
        'valor_despues',
        'batch_id',
    ];
}
