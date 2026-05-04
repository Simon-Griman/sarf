<?php

namespace App\Traits;

use App\Models\RegistrosEliminados;
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
            }
        });
    }
}