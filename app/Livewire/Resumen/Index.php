<?php

namespace App\Livewire\Resumen;

use App\Models\Operacion;
use App\Models\Producto;
use App\Models\Resumen;
use App\Models\TerminalDestino;
use App\Models\TerminalOrigen;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $paginate = 10, $modalOpen = false, $borrarResumen, $nro_embarque;

    public $filters = [
        'terminal_origen_id' => '',
        'terminal_destino_id' => '',
        'buque' => '',
        'nro_embarque' => '',
        'nro_viaje' => '',
        'operacion_id' => '',
        'producto_id' => '',
        'volumen' => '',
        'fecha_inicio' => '',
        'fecha_fin' => '',
    ];

    public $columns = [
        //'origen' => true,
        'destino' => true,
        'buque' => true,
        'nro_embarque' => true,
        'nro_viaje' => true,
        'operacion' => true,
        'producto' => true,
        'volumen' => false,
        'fecha' => false,
    ];

    public function updatingFilters()
    {
        $this->resetPage();
    }

    public function modalBorrar($id)
    {
        $this->nro_embarque = Resumen::find($id)->nro_embarque;

        $this->borrarResumen = $id;

        $this->modalOpen = true;
    }

    public function borrar()
    {
        if (!$this->borrarResumen) {
             $this->dispatch('notify', 
                message: 'No se ha seleccionado ningún resumen para eliminar', 
                icon: 'error',
                title: '¡Error!'
            );
            return;
        }

        // 1. Buscamos y borramos
        $resumen = Resumen::find($this->borrarResumen);
        
        if ($resumen) {
             $resumen->delete();
        }

        // 2. Cerramos el modal (esto actualizará el x-show de Alpine automáticamente)
        $this->modalOpen = false;

        // 3. Opcional: Limpiar las variables para la próxima vez
        $this->reset(['borrarResumen', 'nro_embarque']);

        // 4. Opcional: Lanzar un mensaje de éxito (toast)
        $this->dispatch('notify', 
            message: 'Resumen eliminado correctamente', 
            icon: 'success',
            title: '¡Hecho!'
        );
    }

    public function crearResumen()
    {
        return redirect()->route('resumen.create');
    }

    public function render()
    {
        $resumenes = Resumen::orderBy('created_at')->with(['terminalOrigen', 'terminalDestino', 'operacion', 'producto']);

        foreach ($this->filters as $column => $value)
        {
            if (!empty($value) && !in_array($column, ['fecha_inicio', 'fecha_fin']))
            {
                if (str_ends_with($column, '_id')) {
                    $resumenes->where($column, $value);
                } 
                else {
                    $resumenes->where($column, 'like', '%' . $value . '%');
                }
            }
        }

        // 1. Si el usuario llenó AMBOS campos de fecha
        if (!empty($this->filters['fecha_inicio']) && !empty($this->filters['fecha_fin'])) {
            $resumenes->whereBetween('resumens.created_at', [
                $this->filters['fecha_inicio'] . ' 00:00:00', // Desde el primer segundo del inicio
                $this->filters['fecha_fin'] . ' 23:59:59'    // Hasta el último segundo del fin
            ]);
        } 
        // 2. Si solo llenó la fecha de inicio, filtramos ese día exacto
        elseif (!empty($this->filters['fecha_inicio'])) {
            $resumenes->whereDate('resumens.created_at', $this->filters['fecha_inicio']);
        }

        $resumenes = $resumenes->paginate($this->paginate);

        $origenes = TerminalOrigen::orderBy('nombre')->get();
        $destinos = TerminalDestino::orderBy('nombre')->get();
        $operaciones = Operacion::orderBy('nombre')->get();
        $productos = Producto::orderBy('nombre')->get();

        return view('livewire.resumen.index', compact('resumenes', 'origenes', 'destinos', 'operaciones', 'productos'));
    }
}
