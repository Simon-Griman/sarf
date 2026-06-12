<?php

namespace App\Livewire\Auditoria;

use App\Models\Cargamento;
use App\Models\Parcela;
use App\Models\RegistrosEliminados;
use App\Models\RespaldoBorrados;
use App\Models\Resumen;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Eliminados extends Component
{
    public $modelo, $nombre, $tabla, $registro_id, $registro, $fecha_hora, $modalOpen=false;

    public function mount()
    {
        $this->registro = Resumen::first();
    }

    public function ver($id, $tabla)
    {
        $this->modelo = $tabla;

        if ($tabla == 'User') $this->registro = User::withTrashed()->find($id);

        elseif ($tabla == 'Resumen') $this->registro = Resumen::withTrashed()->find($id);

        elseif ($tabla == 'Cargamento') $this->registro = Cargamento::withTrashed()->find($id);

        elseif ($tabla == 'Parcela') $this->registro = Parcela::withTrashed()->find($id);

        elseif ($tabla == 'Role') $this->registro = RespaldoBorrados::where('role_id', $id)->first();

        $this->modalOpen = true;
    }

    public function restaurar()
    {
        $this->modalOpen = false;

        if ($this->modelo == 'Resumen')
        {
            $nro_viaje = $this->registro->nro_viaje;

            $match = Resumen::where('nro_viaje', $nro_viaje)->first();

            if (!$match)
            {
                $this->registro->restore();

                $this->dispatch('notify', 
                    message: 'Resumen restaurado correctamente', 
                    icon: 'success',
                    title: '¡Hecho!'
                );
            }

            else
            {
                $this->dispatch('notify', 
                    message: 'El resumen ya existe', 
                    icon: 'error',
                    title: '¡Error!'
                );
            }
        }

        elseif ($this->modelo == 'Cargamento')
        {
            $nro_viaje = $this->registro->nro_ruta;

            $match = Cargamento::where('nro_ruta', $nro_viaje)->first();

            if (!$match)
            {
                $this->registro->restore();

                $this->dispatch('notify', 
                    message: 'Resumen restaurado correctamente', 
                    icon: 'success',
                    title: '¡Hecho!'
                );
            }

            else
            {
                $this->dispatch('notify', 
                    message: 'El resumen ya existe', 
                    icon: 'error',
                    title: '¡Error!'
                );
            }
        }

        elseif ($this->modelo == 'User')
        {
            $cedula = $this->registro->cedula;
            $email = $this->registro->email;

            $match = User::where('cedula', $cedula)->orWhere('email', $email)->first();

            if (!$match)
            {
                $this->registro->restore();

                $this->dispatch('notify', 
                    message: 'Usuario restaurado correctamente', 
                    icon: 'success',
                    title: '¡Hecho!'
                );
            }

            else
            {
                $this->dispatch('notify', 
                    message: 'El usuario ya existe', 
                    icon: 'error',
                    title: '¡Error!'
                );
            }
        }
    }

    public function render()
    {
        $fecha = new Carbon();

        $eliminados = RegistrosEliminados::select('name', 'model_type', 'model_id', 'registros_eliminados.created_at as fecha')
            ->join('users', 'users.id', '=', 'user_id')
            ->where('name', 'like', '%' . $this->nombre . '%')
            ->where('model_type', 'like', '%' . $this->tabla . '%')
            ->where('model_id', 'like', '%' . $this->registro_id . '%')
            ->where('registros_eliminados.created_at', 'like', '%' . $this->fecha_hora . '%')
            ->orderBy('fecha', 'desc')
            ->paginate()
        ;

        return view('livewire.auditoria.eliminados', compact('eliminados', 'fecha'));
    }
}