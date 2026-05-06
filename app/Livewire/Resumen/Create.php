<?php

namespace App\Livewire\Resumen;

use App\Models\Operacion;
use App\Models\Producto;
use App\Models\Resumen;
use App\Models\TerminalDestino;
use App\Models\TerminalOrigen;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $tipo_operacion;

    public $terminal_origen_id, $terminal_destino_id, $buque, $nro_embarque, $fecha_operacion, $nro_viaje, $producto_id, $volumen, $inspector, $cantidad_determinada, $documento, $TOV, $GOV, $GSV, $NSV, $TCV, $sediment_water, $free_water, $agua_sedimento, $azufre, $temp, $API, $VEF, $nominacion, $embarque, $cantidad, $calidad, $hoja_tiempo, $acta, $ullage_inicial, $ullage_final;

    //carga
    public $OBQ, $OBQ_agua, $TCV_carga, $GSV_carga, $NSV_carga, $TRV, $TRV_ajustado;

    //descarga
    public $ROB, $ROB_agua, $TCV_descarga, $GSV_descarga, $NSV_descarga, $TDV, $TDV_ajustado;

    public function rules()
    {
        return [
            'terminal_origen_id' => 'required',
            'terminal_destino_id' => 'required',
            'buque' => 'required|max:45',
            'nro_embarque' => 'required|integer|max:999999999999|min:10',
            'fecha_operacion' => 'required|date',
            'nro_viaje' => ['required', 'integer', 'min:10000', 'max:10000000', Rule::unique('resumens', 'nro_viaje')->whereNull('deleted_at')],
            'producto_id' => 'required',
            'volumen' => 'required|integer|max:999999999999|min:100',
            'inspector' => 'nullable|max:45',
            'cantidad_determinada' => 'required',
            'documento' => 'required',
            'TOV' => 'required|decimal:2|max:999999.99|min:1.00',
            'GOV' => 'required|decimal:2|max:999999.99|min:1.00',
            'GSV' => 'required|decimal:2|max:999999.99|min:1.00',
            'NSV' => 'required|decimal:2|max:999999.99|min:1.00',
            'TCV' => 'required|decimal:2|max:999999.99|min:1.00',
            'sediment_water' => 'required|decimal:2|max:9999.99|min:1.00',
            'free_water' => 'required|decimal:2|max:9999.99|min:1.00',
            'agua_sedimento' => 'required|decimal:2|max:9999.99|min:1.00',
            'temp' => 'required|integer|max:9999',
            'API' => 'required|integer|max:9999',
            'azufre' => 'required|integer|max:9999',

            'OBQ' => ['nullable', 'required_if:tipo_operacion,carga,importacion', 'integer', 'max:999999'],
            'OBQ_agua' => ['nullable', 'required_if:tipo_operacion,carga,importacion', 'integer', 'max:999999'],
            'TCV_carga' => ['nullable', 'required_if:tipo_operacion,carga,importacion', 'integer', 'max:999999'],
            'GSV_carga' => ['nullable', 'required_if:tipo_operacion,carga,importacion', 'integer', 'max:999999'],
            'NSV_carga' => ['nullable', 'required_if:tipo_operacion,carga,importacion', 'integer', 'max:999999'],
            'TRV' => ['nullable', 'required_if:tipo_operacion,carga,importacion', 'integer', 'max:999999'],
            'TRV_ajustado' => ['nullable', 'required_if:tipo_operacion,carga,importacion', 'integer', 'max:999999'],

            'ROB' => ['nullable', 'required_if:tipo_operacion,descarga,exportacion', 'integer', 'max:999999'],
            'ROB_agua' => ['nullable', 'required_if:tipo_operacion,descarga,exportacion', 'integer', 'max:999999'],
            'TCV_descarga' => ['nullable', 'required_if:tipo_operacion,descarga,exportacion', 'integer', 'max:999999'],
            'GSV_descarga' => ['nullable', 'required_if:tipo_operacion,descarga,exportacion', 'integer', 'max:999999'],
            'NSV_descarga' => ['nullable', 'required_if:tipo_operacion,descarga,exportacion', 'integer', 'max:999999'],
            'TDV' => ['nullable', 'required_if:tipo_operacion,descarga,exportacion', 'integer', 'max:999999'],
            'TDV_ajustado' => ['nullable', 'required_if:tipo_operacion,descarga,exportacion', 'integer', 'max:999999'],
            'VEF' => 'required|decimal:4|max:10.0000|min:0.0001',

            //archivos
            'nominacion' => 'required',
            'embarque' => 'required',
            'cantidad' => 'required',
            'calidad' => 'required',
            'hoja_tiempo' => 'required',
            'acta' => 'required',
            'ullage_inicial' => 'required',
            'ullage_final' => 'required',
        ];
    }

    public function mount()
    {
        if (!$this->tipo_operacion)
        {
            return redirect()->route('resumen.index');
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        $operaciones = Operacion::all();
        $operacion_id = 0;

        foreach ($operaciones as $operacion)
        {
            if (Str::ascii(Str::lower($operacion->nombre)) == Str::ascii(Str::lower($this->tipo_operacion))) {
                $operacion_id = $operacion->id;
            }
        }

        if ($operacion_id == 0)
        {
            return redirect()->route('resumen.index')->with('error', 'Error en la Operación');
        }

        if ($this->inspector == '') $this->inspector = 'SAMH';

        $nominacion = $this->nominacion->store('images/nominacion', 'public');
        $embarque = $this->embarque->store('images/embarque', 'public');
        $cantidad = $this->cantidad->store('images/certificados/cantidad', 'public');
        $calidad = $this->calidad->store('images/certificados/calidad', 'public');
        $hoja_tiempo = $this->hoja_tiempo->store('images/hoja_tiempo', 'public');
        $acta = $this->acta->store('images/acta', 'public');
        $ullage_inicial = $this->ullage_inicial->store('images/ullage/inicial', 'public');
        $ullage_final = $this->ullage_final->store('images/ullage/final', 'public');

        Resumen::create([
            'terminal_origen_id' => $this->terminal_origen_id,
            'terminal_destino_id' => $this->terminal_destino_id,
            'buque' => $this->buque,
            'nro_embarque' => $this->nro_embarque,
            'fecha_operacion' => $this->fecha_operacion,
            'nro_viaje' => $this->nro_viaje,
            'operacion_id' => $operacion_id,
            'producto_id' => $this->producto_id,
            'volumen' => $this->volumen,
            'inspector' => $this->inspector,
            'cantidad_determinada' => $this->cantidad_determinada,
            'documento' => $this->documento,
            'TOV' => $this->TOV,
            'GOV' => $this->GOV,
            'GSV' => $this->GSV,
            'NSV' => $this->NSV,
            'TCV' => $this->TCV,
            'sediment_water' => $this->sediment_water,
            'free_water' => $this->free_water,
            'agua_sedimento' => $this->agua_sedimento,
            'temp' => $this->temp,
            'API' => $this->API,
            'azufre' => $this->azufre,

            'OBQ' => $this->OBQ,
            'OBQ_agua' => $this->OBQ_agua,
            'TCV_carga' => $this->TCV_carga,
            'GSV_carga' => $this->GSV_carga,
            'NSV_carga' => $this->NSV_carga,
            'TRV' => $this->TRV,
            'TRV_ajustado' => $this->TRV_ajustado,

            'ROB' => $this->ROB,
            'ROB_agua' => $this->ROB_agua,
            'TCV_descarga' => $this->TCV_descarga,
            'GSV_descarga' => $this->GSV_descarga,
            'NSV_descarga' => $this->NSV_descarga,
            'TDV' => $this->TDV,
            'TDV_ajustado' => $this->TDV_ajustado,

            'VEF' => $this->VEF,

            'nominacion' => $nominacion,
            'embarque' => $embarque,
            'cantidad' => $cantidad,
            'calidad' => $calidad,
            'hoja_tiempo' => $hoja_tiempo,
            'acta' => $acta,
            'ullage_inicial' => $ullage_inicial,
            'ullage_final' => $ullage_final,
        ]);

        return redirect()->route('resumen.index')->with('success', 'Resumen Agregado Correctamente');
    }

    public function render()
    {
        $origenes = TerminalOrigen::orderBy('nombre')->get();
        $destinos = TerminalDestino::orderBy('nombre')->get();
        $productos = Producto::orderBy('nombre')->get();

        return view('livewire.resumen.create', compact('origenes', 'destinos', 'productos'));
    }
}
