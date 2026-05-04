<?php

namespace App\Livewire\Auditoria;

use App\Models\RegistrosEliminados;
use App\Models\Resumen;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Eliminados extends Component
{
    public $modelo, $nombre, $tabla, $registro_id, $registro, $fecha_hora, $modalOpen=false;

    public function mount()
    {
        $this->registro = User::first();
    }

    public function ver($id, $tabla)
    {
        $this->modelo = $tabla;

        if ($tabla == 'User') $this->registro = User::withTrashed()->find($id);

        elseif ($tabla == 'Resumen') $this->registro = Resumen::withTrashed()->find($id);

        $this->modalOpen = true;
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