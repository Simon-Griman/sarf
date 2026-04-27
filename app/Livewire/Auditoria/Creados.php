<?php

namespace App\Livewire\Auditoria;

use App\Models\Cintillo;
use App\Models\RegistrosCreados;
use App\Models\Resumen;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Creados extends Component
{
    public $nombre, $tabla, $registro_id, $fecha_hora, $registro, $modalOpen=false, $modelo;

    public function mount()
    {
        $this->registro = new Resumen;
    }

    public function ver($id, $tabla)
    {
        $this->modelo = $tabla;

        if ($tabla == 'Resumen') $this->registro = Resumen::find($id);

        elseif ($tabla == 'User') $this->registro = User::find($id);

        elseif ($tabla == 'Role') $this->registro = Role::find($id);

        elseif ($tabla == 'Cintillo') $this->registro = Cintillo::find($id);

        else return;

        $this->modalOpen = true;
    }

    public function render()
    {
        $fecha = new Carbon();

        $creados = RegistrosCreados::select('name', 'model_type', 'model_id', 'registros_creados.created_at as fecha')
            ->join('users', 'users.id', '=', 'user_id')
            ->where('name', 'like', '%' . $this->nombre . '%')
            ->where('model_type', 'like', '%' . $this->tabla . '%')
            ->where('model_id', 'like', '%' . $this->registro_id . '%')
            ->where('registros_creados.created_at', 'like', '%' . $this->fecha_hora . '%')
            ->orderBy('fecha', 'desc')
            ->paginate()
        ;

        return view('livewire.auditoria.creados', compact('creados', 'fecha'));
    }
}
