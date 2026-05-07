<?php

namespace App\Traits;

use App\Models\RegistrosEliminados;
use App\Models\RespaldoBorrados;
use App\Models\Role;
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
            }
        });
    }
}