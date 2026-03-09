<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Operacion extends Model
{
    protected $fillable = [
        'nombre',
    ];

    public function resumens(): HasMany
    {
        return $this->hasMany(Resumen::class);
    }
}
