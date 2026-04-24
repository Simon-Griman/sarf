<?php

namespace App\Traits;

use App\Models\RegistrosCreados;
use Illuminate\Support\Facades\Auth;

trait TracksCreacion
{
    public static function bootTracksCreacion()
    {
        static::created(function($model)
        {
            if (Auth::check())
            {
                RegistrosCreados::create([
                    'user_id' => Auth::id(),
                    'model_type' => get_class($model),
                    'model_id' => $model->id,
                ]);
            }
        });
    }
}