<?php

namespace App\Models;

use App\Traits\TracksCreacion;
use App\Traits\TracksEdicion;
use App\Traits\TracksEliminacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TerminalOrigen extends Model
{
    use HasFactory, TracksCreacion, TracksEdicion, TracksEliminacion;

    protected $fillable = [
        'nombre',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function resumenes(): HasMany
    {
        return $this->hasMany(Resumen::class);
    }

    public function rutas(): HasMany
    {
        return $this->hasMany(Ruta::class);
    }
}
