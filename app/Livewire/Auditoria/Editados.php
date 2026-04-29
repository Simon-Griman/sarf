<?php

namespace App\Livewire\Auditoria;

use App\Models\RegistrosEditados;
use App\Models\RespaldoEditados;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Editados extends Component
{
    public $nombre, $tabla, $registro_id, $fecha_hora, $modelo, $modalOpen=false, $batch;

    public function mount()
    {
        $this->batch = RespaldoEditados::find(1);
    }

    public function ver($id, $tabla)
    {
        $this->modelo = $tabla;

        $this->batch = RespaldoEditados::where('batch_id', $id)->get();

        $this->modalOpen = true;
    }

    public function render()
    {
        $fecha = new Carbon();

        $creados = RegistrosEditados::select('name', 'model_type', 'model_id', 'registros_editados.created_at as fecha', 'batch_id')
            ->join('users', 'users.id', '=', 'user_id')
            ->where('name', 'like', '%' . $this->nombre . '%')
            ->where('model_type', 'like', '%' . $this->tabla . '%')
            ->where('model_id', 'like', '%' . $this->registro_id . '%')
            ->where('registros_editados.created_at', 'like', '%' . $this->fecha_hora . '%')
            ->orderBy('fecha', 'desc')
            ->paginate()
        ;

        return view('livewire.auditoria.editados', compact('creados', 'fecha'));
    }
}