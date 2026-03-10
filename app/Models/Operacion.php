<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Operacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public function resumens(): HasMany
    {
        return $this->hasMany(Resumen::class);
    }
}
