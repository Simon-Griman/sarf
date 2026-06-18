<?php

namespace App\Traits;

use App\Models\Cargamento;
use App\Models\Cintillo;
use App\Models\Inspector;
use App\Models\Operacion;
use App\Models\Parcela;
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
                        $valorAntes = TerminalOrigen::find($antes)->nombre ?? null;
                        $valorDespues = TerminalOrigen::find($value)->nombre ?? null;
                        $campo = 'Origen';
                    }

                    elseif ($key == 'terminal_destino_id')
                    {
                        $valorAntes = TerminalDestino::find($antes)->nombre ?? null;
                        $valorDespues = TerminalDestino::find($value)->nombre ?? null;
                        $campo = 'Destino';
                    }

                    elseif ($key == 'operacion_id')
                    {
                        $valorAntes = Operacion::find($antes)->nombre ?? null;
                        $valorDespues = Operacion::find($value)->nombre ?? null;
                        $campo = 'Operación';
                    }

                    elseif ($key == 'producto_id')
                    {
                        $valorAntes = Producto::find($antes)->nombre ?? null;
                        $valorDespues = Producto::find($value)->nombre ?? null;
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

                elseif ($model instanceof Cargamento)
                {
                    if ($key == 'terminal_origen_id')
                    {
                        $valorAntes = TerminalOrigen::find($antes)->nombre ?? null;
                        $valorDespues = TerminalOrigen::find($value)->nombre ?? null;
                        $campo = 'Origen';
                    }

                    elseif ($key == 'operacion_id')
                    {
                        $valorAntes = Operacion::find($antes)->nombre ?? null;
                        $valorDespues = Operacion::find($value)->nombre ?? null;
                        $campo = 'Operación';
                    }

                    elseif ($key == 'inspector_id')
                    {
                        $valorAntes = Inspector::find($antes)->nombre ?? null;
                        $valorDespues = Inspector::find($value)->nombre ?? null;
                        $campo = 'Inspector';
                    }

                    else
                    {
                        $valorAntes = $antes;
                        $valorDespues = $value;
                        $campo = $key;
                    }

                    RespaldoEditados::create([
                        'cargamento_id' => $model->id,
                        'batch_id' => $batchId,
                        'campo' => $campo,
                        'valor_antes' => $valorAntes,
                        'valor_despues' => $valorDespues,
                    ]);
                }

                elseif ($model instanceof Parcela)
                {
                    if ($key == 'terminal_destino_id')
                    {
                        $valorAntes = TerminalDestino::find($antes)->nombre ?? null;
                        $valorDespues = TerminalDestino::find($value)->nombre ?? null;
                        $campo = 'Destino';
                    }

                    elseif ($key == 'producto_id')
                    {
                        $valorAntes = Producto::find($antes)->nombre ?? null;
                        $valorDespues = Producto::find($value)->nombre ?? null;
                        $campo = 'Producto';
                    }

                    else
                    {
                        $valorAntes = $antes;
                        $valorDespues = $value;
                        $campo = $key;
                    }

                    RespaldoEditados::create([
                        'parcela_id' => $model->id,
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
                        $valorAntes = TerminalOrigen::find($antes)->nombre ?? null;
                        $valorDespues = TerminalOrigen::find($value)->nombre ?? null;
                        $campo = 'Origen';
                    }

                    elseif ($key == 'password')
                    {
                        $valorAntes = '';
                        $valorDespues = '';
                        $campo = 'Contraseña';
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
                        'valor_antes' => $valorAntes,
                        'valor_despues' => $valorDespues,
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