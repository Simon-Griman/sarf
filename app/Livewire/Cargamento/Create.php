<?php

namespace App\Livewire\Cargamento;

use App\Models\Cargamento;
use App\Models\FormField;
use App\Models\Inspector;
use App\Models\Operacion;
use App\Models\TerminalDestino;
use App\Models\TerminalOrigen;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $terminal_origen_id, $buque, $nro_embarque, $fecha_operacion, $operacion_id, $nro_ruta, $inspector_id, $cantidad_determinada, $documento, $nominacion, $embarque, $cantidad, $calidad, $hoja_tiempo, $acta, $ullage_inicial, $ullage_final, $validaciones = [];

    public function mount()
    {
        $this->validaciones = FormField::pluck('is_required', 'field_name')->toArray();
    }

    public function rules()
    {
        return [
            'terminal_origen_id' => ($this->validaciones['terminal_origen'] ?? false) ? 'required' : 'nullable',
            'buque' => ($this->validaciones['buque'] ?? false) ? 'required|max:45' : 'nullable|max:45',
            'nro_embarque' => ['required', 'integer', 'min:100000', 'max:9999999999999', Rule::unique('cargamentos', 'nro_embarque')->whereNull('deleted_at')],
            'fecha_operacion' => ($this->validaciones['fecha_operacion'] ?? false) ? 'required|date' : 'nullable|date',
            'operacion_id' => 'required',
            'nro_ruta' => ['required', 'integer', 'min:10000', 'max:1000000000', Rule::unique('cargamentos', 'nro_ruta')->whereNull('deleted_at')],
            'inspector_id' => ($this->validaciones['inspector'] ?? false) ? 'required' : 'nullable',
            'cantidad_determinada' => ($this->validaciones['cantidad_determinada'] ?? false) ? 'required' : 'nullable',

            //archivos
            'nominacion' => ($this->validaciones['nominacion'] ?? false) ? 'required' : 'nullable',
            'embarque' => ($this->validaciones['embarque'] ?? false) ? 'required' : 'nullable',
            'cantidad' => ($this->validaciones['cantidad'] ?? false) ? 'required' : 'nullable',
            'calidad' => ($this->validaciones['calidad'] ?? false) ? 'required' : 'nullable',
            'hoja_tiempo' => ($this->validaciones['hoja_tiempo'] ?? false) ? 'required' : 'nullable',
            'acta' => ($this->validaciones['acta'] ?? false) ? 'required' : 'nullable',
            'ullage_inicial' => ($this->validaciones['ullage_inicial'] ?? false) ? 'required' : 'nullable',
            'ullage_final' => ($this->validaciones['ullage_final'] ?? false) ? 'required' : 'nullable',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // En tu componente de Livewire de Cargamento
    public function updatedCantidadDeterminada($value)
    {
        if ($value === '') {
            $this->cantidad_determinada = null;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->nominacion) {
            $nominacion = $this->nominacion->store('images/nominacion', 'public');
        } else {
            $nominacion = null;
        }
        if ($this->embarque) {
            $embarque = $this->embarque->store('images/embarque', 'public');
        } else {
            $embarque = null;
        }
        if ($this->cantidad) {
            $cantidad = $this->cantidad->store('images/certificados/cantidad', 'public');
        } else {
            $cantidad = null;
        }
        if ($this->calidad) {
            $calidad = $this->calidad->store('images/certificados/calidad', 'public');
        } else {
            $calidad = null;
        }
        if ($this->hoja_tiempo) {
            $hoja_tiempo = $this->hoja_tiempo->store('images/hoja_tiempo', 'public');
        } else {
            $hoja_tiempo = null;
        }
        if ($this->acta) {
            $acta = $this->acta->store('images/acta', 'public');
        } else {
            $acta = null;
        }
        if ($this->ullage_inicial) {
            $ullage_inicial = $this->ullage_inicial->store('images/ullage/inicial', 'public');
        } else {
            $ullage_inicial = null;
        }
        if ($this->ullage_final) {
            $ullage_final = $this->ullage_final->store('images/ullage/final', 'public');
        } else {
            $ullage_final = null;
        }

        if (!$this->terminal_origen_id) {
            $this->terminal_origen_id = null;
        }

        Cargamento::create([
            'terminal_origen_id' => $this->terminal_origen_id,
            'buque' => $this->buque,
            'nro_embarque' => $this->nro_embarque,
            'fecha_operacion' => $this->fecha_operacion,
            'operacion_id' => $this->operacion_id,
            'nro_ruta' => $this->nro_ruta,
            'inspector_id' => $this->inspector_id,
            'cantidad_determinada' => $this->cantidad_determinada,

            'nominacion' => $nominacion,
            'embarque' => $embarque,
            'cantidad' => $cantidad,
            'calidad' => $calidad,
            'hoja_tiempo' => $hoja_tiempo,
            'acta' => $acta,
            'ullage_inicial' => $ullage_inicial,
            'ullage_final' => $ullage_final,
        ]);

        return redirect()->route('cargamento.index')->with('success', 'Cargamento Agregado Correctamente');
    }

    public function render()
    {
        $origenes = TerminalOrigen::orderBy('nombre')->get();
        $destinos = TerminalDestino::orderBy('nombre')->get();
        $inspectores = Inspector::orderBy('nombre')->get();
        $operaciones = Operacion::orderBy('nombre')->get();

        return view('livewire.cargamento.create', compact('origenes', 'destinos', 'inspectores', 'operaciones'));
    }
}
