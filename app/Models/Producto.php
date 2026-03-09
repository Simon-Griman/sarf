<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
    ];

    public function resumenes(): HasMany
    {
        return $this->hasMany(Resumen::class);
    }
}
