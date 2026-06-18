<?php

namespace App\Livewire;

use App\Models\FormField;
use Livewire\Component;

class Validaciones extends Component
{
    // Aquí guardaremos el estado de los checkboxes: [id => true/false]
    public array $settings = [];

    public function mount()
    {
        // Al cargar el componente, extraemos los datos de la BD
        $this->settings = FormField::pluck('is_required', 'id')->toArray();
    }

    /**
     * Este método mágico de Livewire se ejecuta automáticamente 
     * cada vez que una propiedad pública cambia en el frontend.
     */
    public function updatedSettings($value, $id)
    {
        // $id contiene la clave del array que cambió (el ID del campo)
        // $value contiene el nuevo estado (true o false)
        
        FormField::where('id', $id)->update([
            'is_required' => $value
        ]);

        // Opcional: Enviar una notificación flash de éxito
        // session()->flash('message', 'Configuración actualizada al instante.');
    }

    public function checkAll()
    {
        // 1. Actualizamos la Base de Datos de golpe
        FormField::query()->update(['is_required' => true]);

        // 2. Actualizamos el estado en memoria para que se refleje en la vista
        foreach ($this->settings as $id => $value) {
            $this->settings[$id] = true;
        }

        $this->dispatch('notify', 
            message: 'Todos los campos se volvieron obligatorios.', 
            icon: 'success',
            title: '¡Hecho!'
        );
    }

    public function uncheckAll()
    {
        // 1. Actualizamos la Base de Datos de golpe
        FormField::query()->update(['is_required' => false]);

        // 2. Actualizamos el estado en memoria para la vista
        foreach ($this->settings as $id => $value) {
            $this->settings[$id] = false;
        }

        $this->dispatch('notify', 
            message: 'Todos los campos se volvieron opcionales.', 
            icon: 'success',
            title: '¡Hecho!'
        );
    }

    public function render()
    {
        $validaciones = FormField::orderBy('field_name', 'asc')->get();

        return view('livewire.validaciones', compact('validaciones'));
    }
}
