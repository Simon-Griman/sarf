<?php

namespace App\Livewire;

use App\Models\TerminalDestino;
use App\Models\TerminalOrigen;
use App\Models\Ruta as ModelsRuta;
use Livewire\Component;

class Ruta extends Component
{
    public $buque, $nro_ruta, $terminal_origen_id, $terminal_destinos_ids = [], $buscarRuta, $ruta, $is_update=false, $ruta_id, $ruta_id_delete;

    public function rules()
    {
        return [
            'buque' => 'required|string|max:45',
            'terminal_origen_id' => 'required',
            'terminal_destinos_ids' => 'required|array',
            // Si es un update, ignoramos el ID actual en la regla unique
            'nro_ruta' => [
                'required',
                'integer',
                'max:9999999',
                'min:100',
                $this->is_update 
                    ? 'unique:rutas,nro_ruta,' . $this->ruta_id 
                    : 'unique:rutas,nro_ruta'
            ],
        ];
    }

    public function save()
    {
        $this->validate();

        ModelsRuta::create([
            'buque' => $this->buque,
            'nro_ruta' => $this->nro_ruta,
            'terminal_origen_id' => $this->terminal_origen_id,
        ])->terminalDestinos()->sync($this->terminal_destinos_ids);

        $this->buque = '';
        $this->nro_ruta = '';
        $this->terminal_origen_id = '';
        $this->terminal_destinos_ids = [];

        $this->dispatch('notify', 
            message: 'Ruta creada correctamente', 
            icon: 'success',
            title: '¡Hecho!'
        );
    }

    public function updatedBuscarRuta($value)
    {
        if (empty($value)) {
            $this->ruta = null;
        }
    }

    public function buscar()
    {
        $this->validate([
            'buscarRuta' => 'required|string|max:255',
        ]);

        $this->ruta = ModelsRuta::with(['terminalOrigen', 'terminalDestinos'])
            ->where('nro_ruta', $this->buscarRuta)
            ->first()
        ;
    }

    public function edit($id)
    {
        // Cargamos la ruta junto con su relación para evitar consultas extras
        $ruta = ModelsRuta::with('terminalDestinos')->find($id);

        if ($ruta) {
            $this->ruta_id = $ruta->id;
            $this->buque = $ruta->buque;
            $this->nro_ruta = $ruta->nro_ruta;
            $this->terminal_origen_id = $ruta->terminalOrigen?->id; // Usamos null-safe por si acaso

            // Extrae solo los IDs de los destinos asociados y conviértelos en un array nativo
            $this->terminal_destinos_ids = $ruta->terminalDestinos->pluck('id')->toArray();

            $this->is_update=true;
        }
    }

    public function update()
    {
        $this->validate();

        $rutaActualizar = ModelsRuta::find($this->ruta_id);
        
        $rutaActualizar->update([
            'buque' => $this->buque,
            'nro_ruta' => $this->nro_ruta,
            'terminal_origen_id' => $this->terminal_origen_id,
        ]);

        // Sincronizamos las terminales de destino
        $rutaActualizar->terminalDestinos()->sync($this->terminal_destinos_ids);

        $this->dispatch('notify', 
            message: 'Ruta actualizada correctamente', 
            icon: 'success',
            title: '¡Hecho!'
        );
    }

    public function confirmDelete($id)
    {
        $this->ruta_id_delete = $id;
        // Desparamos un evento del navegador para que Alpine abra el modal
        $this->dispatch('open-modal', name: 'delete-route-modal');
    }

    public function delete()
    {
        if ($this->ruta_id_delete) {
            $ruta = ModelsRuta::find($this->ruta_id_delete);
            
            if ($ruta) {
                // Eliminamos las relaciones en la tabla pivote primero
                $ruta->terminalDestinos()->detach();
                // Eliminamos la ruta
                $ruta->delete();
                
                // Si la ruta eliminada era la que se estaba mostrando en la búsqueda, la limpiamos
                if ($this->ruta && $this->ruta->id == $this->ruta_id_delete) {
                    $this->ruta = null;
                    $this->buscarRuta = '';
                }
            }

            $this->ruta_id_delete = null;

            // Cerramos el modal desde Livewire
            $this->dispatch('close-modal', name: 'delete-route-modal');

            $this->dispatch('notify', 
                message: 'Ruta eliminada correctamente', 
                icon: 'success',
                title: '¡Eliminado!'
            );
        }
    }

    public function render()
    {
        $destinos = TerminalDestino::orderBy('nombre')->get();
        $origenes = TerminalOrigen::orderBy('nombre')->get();

        return view('livewire.ruta', compact('destinos', 'origenes'));
    }
}
