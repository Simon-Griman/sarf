<?php

namespace App\Livewire\Cargamento;

use App\Models\Cargamento;
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

    public $terminal_origen_id, $buque, $nro_embarque, $fecha_operacion, $operacion_id, $nro_ruta, $inspector_id, $cantidad_determinada, $documento, $nominacion, $embarque, $cantidad, $calidad, $hoja_tiempo, $acta, $ullage_inicial, $ullage_final;

    public function rules()
    {
        return [
            'terminal_origen_id' => 'required',
            'buque' => 'required|max:45',
            'nro_embarque' => ['required', 'integer', 'min:100000', 'max:9999999999999', Rule::unique('cargamentos', 'nro_embarque')->whereNull('deleted_at')],
            'fecha_operacion' => 'required|date',
            'operacion_id' => 'required',
            'nro_ruta' => ['required', 'integer', 'min:10000', 'max:1000000000', Rule::unique('cargamentos', 'nro_ruta')->whereNull('deleted_at')],
            'inspector_id' => 'required',
            'cantidad_determinada' => 'required',

            //archivos
            'nominacion' => 'required',
            'embarque' => 'required',
            'cantidad' => 'required',
            'calidad' => 'required',
            'hoja_tiempo' => 'required',
            'acta' => 'nullable',
            'ullage_inicial' => 'required',
            'ullage_final' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        $nominacion = $this->nominacion->store('images/nominacion', 'public');
        $embarque = $this->embarque->store('images/embarque', 'public');
        $cantidad = $this->cantidad->store('images/certificados/cantidad', 'public');
        $calidad = $this->calidad->store('images/certificados/calidad', 'public');
        $hoja_tiempo = $this->hoja_tiempo->store('images/hoja_tiempo', 'public');
        if ($this->acta) {
            $acta = $this->acta->store('images/acta', 'public');
        } else {
            $acta = null;
        }
        $ullage_inicial = $this->ullage_inicial->store('images/ullage/inicial', 'public');
        $ullage_final = $this->ullage_final->store('images/ullage/final', 'public');

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
