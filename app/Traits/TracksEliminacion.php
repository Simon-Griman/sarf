<?php

namespace App\Traits;

use App\Models\RegistrosEliminados;
use App\Models\RespaldoBorrados;
use App\Models\Role;
use App\Models\TerminalDestino;
use App\Models\TerminalOrigen;
use Illuminate\Support\Facades\Auth;

trait TracksEliminacion
{
    public static function bootTracksEliminacion()
    {
        static::deleted(function($model)
        {
            if (Auth::check())
            {
                RegistrosEliminados::create([
                    'user_id' => Auth::id(),
                    'model_type' => get_class($model),
                    'model_id' => $model->id,
                ]);

                if ($model instanceof Role)
                {
                    RespaldoBorrados::create([
                        'role_id' => $model->id,
                        'role' => $model->name,
                        'peso' => $model->peso,
                        'deleted_at' => now()
                    ]);
                }

                elseif ($model instanceof TerminalDestino)
                {
                    RespaldoBorrados::create([
                        'terminal_destino_id' => $model->id,
                        'terminal_destino' => $model->nombre,
                        'deleted_at' => now()
                    ]);
                }

                elseif ($model instanceof TerminalOrigen)
                {
                    RespaldoBorrados::create([
                        'terminal_origen_id' => $model->id,
                        'terminal_origen' => $model->nombre,
                        'deleted_at' => now()
                    ]);
                }
            }
        });
    }
}