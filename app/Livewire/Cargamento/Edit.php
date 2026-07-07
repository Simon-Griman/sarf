<?php

namespace App\Livewire\Cargamento;

use App\Models\Cargamento;
use App\Models\FormField;
use App\Models\Inspector;
use App\Models\Operacion;
use App\Models\Ruta;
use App\Models\TerminalOrigen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $cargamento_id;

    public $nro_embarque, $fecha_operacion, $operacion_id, $nro_ruta, $inspector_id, $documento, $nominacion, $nominacion_existente, $embarque, $embarque_existente, $cantidad, $cantidad_existente, $calidad, $calidad_existente, $hoja_tiempo, $hoja_tiempo_existente, $acta, $acta_existente, $ullage_inicial, $ullage_inicial_existente, $ullage_final, $ullage_final_existente, $tipo_operacion, $validaciones = [];

    public function mount()
    {
        $cargamento = Cargamento::findOrFail($this->cargamento_id);

        $this->nro_embarque = $cargamento->nro_embarque;
        $this->fecha_operacion = $cargamento->fecha_operacion;
        $this->operacion_id = $cargamento->operacion_id;
        $this->nro_ruta = $cargamento->ruta->nro_ruta;
        $this->inspector_id = $cargamento->inspector_id;
        $this->documento = $cargamento->documento;

        $this->nominacion_existente = $cargamento->nominacion;
        $this->embarque_existente = $cargamento->embarque;
        $this->cantidad_existente = $cargamento->cantidad;
        $this->calidad_existente = $cargamento->calidad;
        $this->hoja_tiempo_existente = $cargamento->hoja_tiempo;
        $this->acta_existente = $cargamento->acta;
        $this->ullage_inicial_existente = $cargamento->ullage_inicial;
        $this->ullage_final_existente = $cargamento->ullage_final;

        $this->validaciones = FormField::pluck('is_required', 'field_name')->toArray();
    }

    public function rules()
    {
        return [
            'nro_embarque' => ['required', 'integer', 'min:100000', 'max:999999999999', Rule::unique('cargamentos', 'nro_embarque')->ignore($this->cargamento_id)->whereNull('deleted_at')],
            'fecha_operacion' => ($this->validaciones['fecha_operacion'] ?? false) ? 'required|date' : 'nullable|date',
            'operacion_id' => 'required',
            'nro_ruta' => ['required', 'integer', 'min:10000', 'max:1000000000', Rule::exists('rutas', 'nro_ruta')->whereNull('deleted_at')],
            'inspector_id' => ($this->validaciones['inspector'] ?? false) ? 'required' : 'nullable',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate();

        $cargamento = Cargamento::find($this->cargamento_id);

        if ($this->nominacion) 
        {
            $nominacion = $this->nominacion->store('images/nominacion', 'public');
            Storage::disk('public')->delete($this->nominacion_existente);
        }
        else $nominacion = $cargamento->nominacion;

        if ($this->embarque)
        {
            $embarque = $this->embarque->store('images/embarque', 'public');
            Storage::disk('public')->delete($this->embarque_existente);
        }
        else $embarque = $cargamento->embarque;

        if ($this->cantidad)
        {
            $cantidad = $this->cantidad->store('images/certificados/cantidad', 'public');
            Storage::disk('public')->delete($this->cantidad_existente);
        }
        else $cantidad = $cargamento->cantidad;

        if ($this->calidad)
        {
            $calidad = $this->calidad->store('images/certificados/calidad', 'public');
            Storage::disk('public')->delete($this->calidad_existente);
        }
        else $calidad = $cargamento->calidad;

        if ($this->hoja_tiempo)
        {
            $hoja_tiempo = $this->hoja_tiempo->store('images/hoja_tiempo', 'public');
            Storage::disk('public')->delete($this->hoja_tiempo_existente);
        }
        else $hoja_tiempo = $cargamento->hoja_tiempo;

        if ($this->acta)
        {
            $acta = $this->acta->store('images/acta', 'public');
            Storage::disk('public')->delete($this->acta_existente);
        }
        else $acta = $cargamento->acta;

        if ($this->ullage_inicial)
        {
            $ullage_inicial = $this->ullage_inicial->store('images/ullage/inicial', 'public');
            Storage::disk('public')->delete($this->ullage_inicial_existente);
        }
        else $ullage_inicial = $cargamento->ullage_inicial;

        if ($this->ullage_final)
        {
            $ullage_final = $this->ullage_final->store('images/ullage/final', 'public');
            Storage::disk('public')->delete($this->ullage_final_existente);
        }
        else $ullage_final = $cargamento->ullage_final;

        $ruta_id = Ruta::where('nro_ruta', $this->nro_ruta)->first()->id;

        $cargamento->update([
            'nro_embarque' => $this->nro_embarque,
            'fecha_operacion' => $this->fecha_operacion,
            'ruta_id' => $ruta_id,
            'operacion_id' => $this->operacion_id,
            'inspector_id' => $this->inspector_id,

            'nominacion' => $nominacion,
            'embarque' => $embarque,
            'cantidad' => $cantidad,
            'calidad' => $calidad,
            'hoja_tiempo' => $hoja_tiempo,
            'acta' => $acta,
            'ullage_inicial' => $ullage_inicial,
            'ullage_final' => $ullage_final,
        ]);

        //$cargamento->terminalDestinos()->sync($this->terminales_destinos_ids);

        return redirect()->route('cargamento.index')->with('success', 'Cargamento Actualizado Correctamente');
    }

    public function render()
    {
        $cargamento = Cargamento::find($this->cargamento_id);
        $this->tipo_operacion = $cargamento->operacion->nombre;

        $origenes = TerminalOrigen::orderBy('nombre')->get();
        $inspectores = Inspector::orderBy('nombre')->get();
        $operaciones = Operacion::orderBy('nombre')->get();

        return view('livewire.cargamento.edit', compact('cargamento', 'origenes', 'inspectores', 'operaciones'));
    }
}
