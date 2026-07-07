<?php

namespace App\Models;

use App\Traits\TracksCreacion;
use App\Traits\TracksEdicion;
use App\Traits\TracksEliminacion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruta extends Model
{
    use SoftDeletes, TracksCreacion, TracksEdicion, TracksEliminacion;

    protected $fillable = [
        'buque',
        'nro_ruta',
        'terminal_origen_id',
    ];

    public function terminalOrigen(): belongsTo
    {
        return $this->belongsTo(TerminalOrigen::class);
    }

    public function terminalDestinos(): belongsToMany
    {
        return $this->belongsToMany(TerminalDestino::class);
    }

    public function cargamentos(): HasMany
    {
        return $this->hasMany(Cargamento::class);
    }
}
