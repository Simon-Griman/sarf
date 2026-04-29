<?php

namespace App\Traits;

use App\Models\Cintillo;
use App\Models\Operacion;
use App\Models\Producto;
use App\Models\RegistrosEditados;
use App\Models\RespaldoEditados;
use App\Models\Resumen;
use App\Models\Role;
use App\Models\TerminalDestino;
use App\Models\TerminalOrigen;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait TracksEdicion
{
    public static function bootTracksEdicion()
    {
        static::updated(function($model)
        {
            $cambios = $model->getChanges();
            unset($cambios['updated_at']);

            if (empty($cambios)) return;

            $batchId = (string) \Illuminate\Support\Str::uuid();

            if (Auth::check())
            {
                RegistrosEditados::create([
                    'user_id' => Auth::id(),
                    'model_type' => get_class($model),
                    'model_id' => $model->id,
                    'batch_id' => $batchId,
                ]);
            }

            else return;

            foreach ($cambios as $key => $value)
            {
                $antes = $model->getOriginal($key);

                if ($model instanceof Resumen)
                {
                    if ($key == 'terminal_origen_id')
                    {
                        $valorAntes = TerminalOrigen::find($antes)->nombre;
                        $valorDespues = TerminalOrigen::find($value)->nombre;
                        $campo = 'Origen';
                    }

                    elseif ($key == 'terminal_destino_id')
                    {
                        $valorAntes = TerminalDestino::find($antes)->nombre;
                        $valorDespues = TerminalDestino::find($value)->nombre;
                        $campo = 'Destino';
                    }

                    elseif ($key == 'operacion_id')
                    {
                        $valorAntes = Operacion::find($antes)->nombre;
                        $valorDespues = Operacion::find($value)->nombre;
                        $campo = 'Operación';
                    }

                    elseif ($key == 'producto_id')
                    {
                        $valorAntes = Producto::find($antes)->nombre;
                        $valorDespues = Producto::find($value)->nombre;
                        $campo = 'Producto';
                    }

                    else
                    {
                        $valorAntes = $antes;
                        $valorDespues = $value;
                        $campo = $key;
                    }

                    RespaldoEditados::create([
                        'resumen_id' => $model->id,
                        'batch_id' => $batchId,
                        'campo' => $campo,
                        'valor_antes' => $valorAntes,
                        'valor_despues' => $valorDespues,
                    ]);
                }

                elseif ($model instanceof User)
                {
                    if ($key == 'terminal_origen_id')
                    {
                        $valorAntes = TerminalOrigen::find($antes)->nombre;
                        $valorDespues = TerminalOrigen::find($value)->nombre;
                        $campo = 'Origen';
                    }

                    else
                    {
                        $valorAntes = $antes;
                        $valorDespues = $value;
                        $campo = $key;
                    }

                    RespaldoEditados::create([
                        'user_id' => $model->id,
                        'batch_id' => $batchId,
                        'campo' => $key,
                        'valor_antes' => $antes,
                        'valor_despues' => $value,
                    ]);
                }

                elseif ($model instanceof Role)
                {
                    $valorAntes = $antes;
                    $valorDespues = $value;
                    $campo = $key;

                    RespaldoEditados::create([
                        'role_id' => $model->id,
                        'batch_id' => $batchId,
                        'campo' => $key,
                        'valor_antes' => $antes,
                        'valor_despues' => $value,
                    ]);
                }

                elseif ($model instanceof Cintillo)
                {
                    $valorAntes = $antes;
                    $valorDespues = $value;
                    $campo = $key;

                    RespaldoEditados::create([
                        'cintillo_id' => $model->id,
                        'batch_id' => $batchId,
                        'campo' => $key,
                        'valor_antes' => $antes,
                        'valor_despues' => $value,
                    ]);
                }
            }
        });
    }
}