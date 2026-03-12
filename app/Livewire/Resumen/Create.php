<?php

namespace App\Livewire\Resumen;

use App\Models\Operacion;
use App\Models\Producto;
use App\Models\Resumen;
use App\Models\TerminalDestino;
use App\Models\TerminalOrigen;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    public $tipo_operacion;

    public $terminal_origen_id, $terminal_destino_id, $buque, $nro_embarque, $nro_viaje, $producto_id, $volumen, $cantidad_determinada, $documento, $TOV, $GOV, $GSV, $NSV, $TCV, $sediment_water, $free_water, $tabla_VCF, $temp, $API, $VEF;

    //carga
    public $OBQ, $OBQ_agua, $TCV_carga, $GSV_carga, $NSV_carga, $TRV, $TRV_ajustado;

    //descarga
    public $ROB, $ROB_agua, $TCV_descarga, $GSV_descarga, $NSV_descarga, $TDV, $TDV_ajustado;

    public function rules()
    {
        return [
            'terminal_origen_id' => 'required',
            'terminal_destino_id' => 'required',
            'buque' => 'required',
            'nro_embarque' => 'required',
            'nro_viaje' => 'required',
            'producto_id' => 'required',
            'volumen' => 'required',
            'cantidad_determinada' => 'required',
            'documento' => 'required',
            'TOV' => 'required',
            'GOV' => 'required',
            'GSV' => 'required',
            'NSV' => 'required',
            'TCV' => 'required',
            'sediment_water' => 'required',
            'free_water' => 'required',
            'tabla_VCF' => 'required',
            'temp' => 'required',
            'API' => 'required',

            'OBQ' => 'required_if:tipo_operacion,carga,importacion',
            'OBQ_agua' => 'required_if:tipo_operacion,carga,importacion',
            'TCV_carga' => 'required_if:tipo_operacion,carga,importacion',
            'GSV_carga' => 'required_if:tipo_operacion,carga,importacion',
            'NSV_carga' => 'required_if:tipo_operacion,carga,importacion',
            'TRV' => 'required_if:tipo_operacion,carga,importacion',
            'TRV_ajustado' => 'required_if:tipo_operacion,carga,importacion',

            'ROB' => 'required_if:tipo_operacion,descarga,exportacion',
            'ROB_agua' => 'required_if:tipo_operacion,descarga,exportacion',
            'TCV_descarga' => 'required_if:tipo_operacion,descarga,exportacion',
            'GSV_descarga' => 'required_if:tipo_operacion,descarga,exportacion',
            'NSV_descarga' => 'required_if:tipo_operacion,descarga,exportacion',
            'TDV' => 'required_if:tipo_operacion,descarga,exportacion',
            'TDV_ajustado' => 'required_if:tipo_operacion,descarga,exportacion',

            'VEF' => 'required',
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

        Resumen::create([
            'terminal_origen_id' => $this->terminal_origen_id,
            'terminal_destino_id' => $this->terminal_destino_id,
            'buque' => $this->buque,
            'nro_embarque' => $this->nro_embarque,
            'nro_viaje' => $this->nro_viaje,
            'operacion_id' => $operacion_id,
            'producto_id' => $this->producto_id,
            'volumen' => $this->volumen,
            'cantidad_determinada' => $this->cantidad_determinada,
            'documento' => $this->documento,
            'TOV' => $this->TOV,
            'GOV' => $this->GOV,
            'GSV' => $this->GSV,
            'NSV' => $this->NSV,
            'TCV' => $this->TCV,
            'sediment_water' => $this->sediment_water,
            'free_water' => $this->free_water,
            'tabla_VCF' => $this->tabla_VCF,
            'temp' => $this->temp,
            'API' => $this->API,

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
