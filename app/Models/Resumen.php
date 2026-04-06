<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resumen extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'terminal_origen_id',
        'terminal_destino_id',
        'buque',
        'nro_embarque',
        'nro_viaje',
        'operacion_id',
        'producto_id',
        'volumen',
        'inspector',
        'cantidad_determinada',
        'documento',
        'TOV',
        'GOV',
        'GSV',
        'NSV',
        'TCV',
        'sediment_water',
        'free_water',
        'tabla_VCF',
        'temp',
        'API',
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
        'nominacion',
        'embarque',
        'cantidad',
        'calidad',
        'hoja_tiempo',
        'acta',
        'ullage_inicial',
        'ullage_final',
    ];

    public function terminalOrigen(): BelongsTo
    {
        return $this->belongsTo(TerminalOrigen::class);
    }

    public function terminalDestino(): BelongsTo
    {
        return $this->belongsTo(TerminalDestino::class);
    }

    public function operacion(): BelongsTo
    {
        return $this->belongsTo(Operacion::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}
