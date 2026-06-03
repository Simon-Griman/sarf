<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parcela extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cargamento_id',
        'producto_id',
        'volumen',
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
}
