<?php

namespace App\Models;

use App\Traits\TracksCreacion;
use App\Traits\TracksEdicion;
use App\Traits\TracksEliminacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TerminalDestino extends Model
{
    use HasFactory, TracksCreacion, TracksEdicion, TracksEliminacion;

    protected $fillable = [
        'nombre',
    ];

    public function resumens(): HasMany
    {
        return $this->hasMany(Resumen::class);
    }

    public function parcelas(): BelongsToMany
    {
        return $this->belongsToMany(Cargamento::class);
    }

    public function rutas(): belongsToMany
    {
        return $this->belongsToMany(TerminalDestino::class);
    }
}
