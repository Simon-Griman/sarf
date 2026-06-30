<?php

namespace App\Models;

use App\Traits\TracksCreacion;
use App\Traits\TracksEdicion;
use App\Traits\TracksEliminacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargamento extends Model
{
    use SoftDeletes, HasFactory, TracksCreacion, TracksEdicion, TracksEliminacion;

    protected $fillable = [
        'terminal_origen_id',
        'parcela_id',
        'buque',
        'nro_embarque',
        'fecha_operacion',
        'ruta_id',
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

    public function ruta(): BelongsTo
    {
        return $this->belongsTo(Ruta::class);
    }
}
