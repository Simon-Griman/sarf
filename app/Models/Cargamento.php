<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargamento extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'terminal_origen_id',
        'parcela_id',
        'buque',
        'nro_embarque',
        'fecha_operacion',
        'nro_ruta',
        'operacion_id',
        'inspector_id',
        'cantidad_determinada',
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

    public function terminalDestinos(): BelongsToMany
    {
        return $this->belongsToMany(TerminalDestino::class);
    }

    public function parcelas(): HasMany
    {
        return $this->hasMany(Parcela::class);
    }

    public function operacion(): BelongsTo
    {
        return $this->belongsTo(Operacion::class);
    }

    public function inspector(): BelongsTo
    {
        return $this->belongsTo(Inspector::class);
    }
}
