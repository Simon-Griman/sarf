<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ruta extends Model
{
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
}
