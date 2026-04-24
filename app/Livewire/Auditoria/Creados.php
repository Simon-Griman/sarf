<?php

namespace App\Livewire\Auditoria;

use App\Models\RegistrosCreados;
use App\Models\Resumen;
use Carbon\Carbon;
use Livewire\Component;

class Creados extends Component
{
    public $nombre, $tabla, $registro_id, $fecha_hora, $registro;

    public function mount()
    {
        $this->registro = Resumen::find(1);
    }

    public function ver($id, $tabla)
    {
        if ($tabla == 'Resumen')
        {
            $this->registro = Resumen::find($id);
        }
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
