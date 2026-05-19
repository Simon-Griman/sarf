<?php

namespace App\Livewire\Terminal;

use App\Models\TerminalDestino;
use Livewire\Component;

class Destino extends Component
{
    public $destino, $modalOpen = false, $accion, $TerminalDestino, $nombre;

    protected $rules = [
        'destino' => 'required|max:45|unique:terminal_destinos,nombre',
    ];

    public function mount()
    {
        $this->TerminalDestino = TerminalDestino::class;
    }

    public function modalCrear()
    {
        $this->modalOpen = true;
        $this->accion = 'crear';
    }

    public function crear()
    {
        $this->validate();

        TerminalDestino::create([
            'nombre' => $this->destino
        ]);

        $this->modalOpen = false;

        $this->destino = '';

        $this->dispatch('notify', 
            message: 'Terminal agregado con exito', 
            icon: 'success',
            title: '¡Hecho!'
        );
    }

    public function modalEditar(TerminalDestino $destino)
    {
        $this->modalOpen = true;
        $this->accion = 'editar';
        $this->destino = $destino->nombre;
        $this->TerminalDestino = $destino;
    }

    public function editar()
    {
        $this->validate();

        $this->TerminalDestino->update([
            'nombre' => $this->destino
        ]);

        $this->modalOpen = false;

        $this->destino = '';

        $this->dispatch('notify', 
            message: 'Terminal actualizado con exito', 
            icon: 'success',
            title: '¡Hecho!'
        );
    }

    public function eliminar(TerminalDestino $destino)
    {
        if ($destino->resumens()->count() > 0) {
            $this->dispatch('notify', 
                message: 'No se puede eliminar el terminal porque tiene resumenes asociados', 
                icon: 'error',
                title: '¡Error!'
            );
            return;
        }

        $destino->delete();

        $this->dispatch('notify', 
            message: 'Terminal eliminado con exito', 
            icon: 'success',
            title: '¡Hecho!'
        );
    }

    public function render()
    {
        $destinos = TerminalDestino::orderBy('nombre')
        ->where('nombre', 'like', '%' . $this->nombre . '%')
        ->get();

        return view('livewire.terminal.destino', compact('destinos'));
    }
}
