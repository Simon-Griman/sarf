<?php

namespace App\Livewire\Cargamento;

use App\Models\Cargamento;
use App\Models\Operacion;
use App\Models\Producto;
use App\Models\TerminalDestino;
use App\Models\TerminalOrigen;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $paginate = 10, $modalOpen = false, $modalOpen2 = false, $modalOpen3 = false, $borrarCargamento, $nro_embarque, $documentos, $cargamentoPdf_id=0, $parcelas;

    public $filters = [
        'terminal_origen_id' => '',
        'buque' => '',
        'nro_embarque' => '',
        'nro_ruta' => '',
        'operacion_id' => '',
        'fecha_inicio' => '',
        'fecha_fin' => '',
        'nominacion' => '',
        'embarque' => '',
        'cantidad' => '',
        'calidad' => '',
        'hoja_tiempo' => '',
        'acta' => '',
        'ullage_inicial' => '',
        'ullage_final' => '',
    ];

    public $columns = [
        //'origen' => true,
        'buque' => true,
        'nro_embarque' => true,
        'nro_ruta' => true,
        'operacion' => true,
        'fecha' => false,
        'documentos' => true,
        'parcelas' => true,
    ];

    public function updatingFilters()
    {
        $this->resetPage();
    }

    public function modalBorrar($id)
    {
        $this->nro_embarque = Cargamento::find($id)->nro_embarque;

        $this->borrarCargamento = $id;

        $this->modalOpen = true;
    }

    public function borrar()
    {
        if (!$this->borrarCargamento) {
             $this->dispatch('notify', 
                message: 'No se ha seleccionado ningún Cargamento para eliminar', 
                icon: 'error',
                title: '¡Error!'
            );
            return;
        }

        // 1. Buscamos y borramos
        $cargamento = Cargamento::find($this->borrarCargamento);
        
        if ($cargamento) {
            $cargamento->delete();
        }

        // 2. Cerramos el modal (esto actualizará el x-show de Alpine automáticamente)
        $this->modalOpen = false;

        // 3. Opcional: Limpiar las variables para la próxima vez
        $this->reset(['borrarCargamento', 'nro_embarque']);

        // 4. Opcional: Lanzar un mensaje de éxito (toast)
        $this->dispatch('notify', 
            message: 'Cargamento eliminado correctamente', 
            icon: 'success',
            title: '¡Hecho!'
        );
    }

    public function verParcelas($id)
    {
        $cargamento = Cargamento::with('parcelas')->find($id);
        $this->parcelas = $cargamento->parcelas;
        
        $this->modalOpen2 = true;
    }

    public function modalDocumento($id)
    {
        $this->documentos = Cargamento::find($id);

        $this->cargamentoPdf_id = $id;

        $this->modalOpen3 = true;
    }

    public function render()
    {
        $cargamentos = Cargamento::with(['terminalOrigen', 'operacion']);

        foreach ($this->filters as $column => $value)
        {
            if (!empty($value) && !in_array($column, ['fecha_inicio', 'fecha_fin']))
            {
                if (str_ends_with($column, '_id')) {
                    $cargamentos->where($column, $value);
                } 
                else {
                    $cargamentos->where($column, 'like', '%' . $value . '%');
                }
            }
        }

        // 1. Si el usuario llenó AMBOS campos de fecha
        if (!empty($this->filters['fecha_inicio']) && !empty($this->filters['fecha_fin'])) {
            $cargamentos->whereBetween('Cargamentos.created_at', [
                $this->filters['fecha_inicio'] . ' 00:00:00', // Desde el primer segundo del inicio
                $this->filters['fecha_fin'] . ' 23:59:59'    // Hasta el último segundo del fin
            ]);
        } 
        // 2. Si solo llenó la fecha de inicio, filtramos ese día exacto
        elseif (!empty($this->filters['fecha_inicio'])) {
            $cargamentos->whereDate('Cargamentos.created_at', $this->filters['fecha_inicio']);
        }

        $cargamentos = $cargamentos->latest()->paginate($this->paginate);

        $origenes = TerminalOrigen::orderBy('nombre')->get();
        $destinos = TerminalDestino::orderBy('nombre')->get();
        $operaciones = Operacion::orderBy('nombre')->get();
        $productos = Producto::orderBy('nombre')->get();

        return view('livewire.cargamento.index', compact('cargamentos', 'origenes', 'destinos', 'operaciones', 'productos'));
    }
}
