<?php

namespace App\Models;

use App\Traits\TracksCreacion;
use App\Traits\TracksEdicion;
use App\Traits\TracksEliminacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parcela extends Model
{
    use HasFactory, SoftDeletes, TracksCreacion, TracksEdicion, TracksEliminacion;

    protected $fillable = [
        'cargamento_id',
        'producto_id',
        'volumen',
        'cantidad_determinada',
        'TOV',
        'GOV',
        'GSV',
        'NSV',
        'TCV',
        'sediment_water',
        'free_water',
        'temp',
        'API',
        'agua_sedimento',
        'azufre',
        'OBQ',
        'OBQ_agua',
        'TCV_carga',
        'GSV_carga',
        'NSV_carga',
        'TRV',
        'TRV_ajustado',
        'ROB',
        'ROB_agua',
        'TCV_descarga',
        'GSV_descarga',
        'NSV_descarga',
        'TDV',
        'TDV_ajustado',
        'VEF',
    ];

    public function cargamento(): BelongsTo
    {
        return $this->belongsTo(Cargamento::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }

    public function terminalDestinos(): BelongsToMany
    {
        return $this->belongsToMany(TerminalDestino::class);
    }
}
