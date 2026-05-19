<?php

namespace App\Livewire\Terminal;

use App\Models\TerminalOrigen;
use Livewire\Component;

class Origen extends Component
{
    public $origen, $modalOpen = false, $accion, $terminalOrigen;

    protected $rules = [
        'origen' => 'required|max:45|unique:terminal_origens,nombre',
    ];

    public function mount()
    {
        $this->terminalOrigen = TerminalOrigen::class;
    }

    public function modalCrear()
    {
        $this->modalOpen = true;
        $this->accion = 'crear';
    }

    public function crear()
    {
        $this->validate();

        TerminalOrigen::create([
            'nombre' => $this->origen
        ]);

        $this->modalOpen = false;

        $this->origen = '';

        $this->dispatch('notify', 
            message: 'Terminal agregado con exito', 
            icon: 'success',
            title: '¡Hecho!'
        );
    }

    public function modalEditar(TerminalOrigen $origen)
    {
        $this->modalOpen = true;
        $this->accion = 'editar';
        $this->origen = $origen->nombre;
        $this->terminalOrigen = $origen;
    }

    public function editar()
    {
        $this->validate();

        $this->terminalOrigen->update([
            'nombre' => $this->origen
        ]);

        $this->modalOpen = false;

        $this->origen = '';

        $this->dispatch('notify', 
            message: 'Terminal actualizado con exito', 
            icon: 'success',
            title: '¡Hecho!'
        );
    }

    public function eliminar(TerminalOrigen $origen)
    {
        if ($origen->resumenes()->count() > 0) {
            $this->dispatch('notify', 
                message: 'No se puede eliminar el terminal porque tiene resumenes asociados', 
                icon: 'error',
                title: '¡Error!'
            );
            return;
        }

        $origen->delete();

        $this->dispatch('notify', 
            message: 'Terminal eliminado con exito', 
            icon: 'success',
            title: '¡Hecho!'
        );
    }

    public function render()
    {
        $origenes = TerminalOrigen::orderBy('nombre')->get();

        return view('livewire.terminal.origen', compact('origenes'));
    }
}
