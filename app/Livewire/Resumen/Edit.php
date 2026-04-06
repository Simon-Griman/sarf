<?php

namespace App\Livewire\Resumen;

use App\Models\Producto;
use App\Models\Resumen;
use App\Models\TerminalDestino;
use App\Models\TerminalOrigen;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $resumen_id;

    public $terminal_origen_id, $terminal_destino_id, $buque, $nro_embarque, $nro_viaje, $producto_id, $tipo_operacion, $volumen, $inspector, $cantidad_determinada, $documento, $TOV, $GOV, $GSV, $NSV, $TCV, $sediment_water, $free_water, $tabla_VCF, $temp, $API, $VEF, $nominacion, $nominacion_existente, $embarque, $embarque_existente, $cantidad, $cantidad_existente, $calidad, $calidad_existente, $hoja_tiempo, $hoja_tiempo_existente, $acta, $acta_existente, $ullage_inicial, $ullage_inicial_existente, $ullage_final, $ullage_final_existente;

    //carga
    public $OBQ, $OBQ_agua, $TCV_carga, $GSV_carga, $NSV_carga, $TRV, $TRV_ajustado;

    //descarga
    public $ROB, $ROB_agua, $TCV_descarga, $GSV_descarga, $NSV_descarga, $TDV, $TDV_ajustado;

    public function mount()
    {
        $resumen = Resumen::find($this->resumen_id);

        $this->terminal_origen_id = $resumen->terminal_origen_id;
        $this->terminal_destino_id = $resumen->terminal_destino_id;
        $this->buque = $resumen->buque;
        $this->nro_embarque = $resumen->nro_embarque;
        $this->nro_viaje = $resumen->nro_viaje;
        $this->producto_id = $resumen->producto_id;
        $this->volumen = $resumen->volumen;
        $this->inspector = $resumen->inspector;
        $this->cantidad_determinada = $resumen->cantidad_determinada;
        $this->documento = $resumen->documento;
        $this->TOV = $resumen->TOV;
        $this->GOV = $resumen->GOV;
        $this->GSV = $resumen->GSV;
        $this->NSV = $resumen->NSV;
        $this->TCV = $resumen->TCV;
        $this->sediment_water = $resumen->sediment_water;
        $this->free_water = $resumen->free_water;
        $this->tabla_VCF = $resumen->tabla_VCF;
        $this->temp = $resumen->temp;
        $this->API = $resumen->API;
        //carga
        $this->OBQ = $resumen->OBQ;
        $this->OBQ_agua = $resumen->OBQ_agua;
        $this->TCV_carga = $resumen->TCV_carga;
        $this->GSV_carga = $resumen->GSV_carga;
        $this->NSV_carga = $resumen->NSV_carga;
        $this->TRV = $resumen->TRV;
        $this->TRV_ajustado = $resumen->TRV_ajustado;
        //descarga
        $this->ROB = $resumen->ROB;
        $this->ROB_agua = $resumen->ROB_agua;
        $this->TCV_descarga = $resumen->TCV_descarga;
        $this->GSV_descarga = $resumen->GSV_descarga;
        $this->NSV_descarga = $resumen->NSV_descarga;
        $this->TDV = $resumen->TDV;
        $this->TDV_ajustado = $resumen->TDV_ajustado;

        $this->VEF = $resumen->VEF;

        $this->nominacion_existente = $resumen->nominacion;
        $this->embarque_existente = $resumen->embarque;
        $this->cantidad_existente = $resumen->cantidad;
        $this->calidad_existente = $resumen->calidad;
        $this->hoja_tiempo_existente = $resumen->hoja_tiempo;
        $this->acta_existente = $resumen->acta;
        $this->ullage_inicial_existente = $resumen->ullage_inicial;
        $this->ullage_final_existente = $resumen->ullage_final;
    }

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
            'inspector' => 'nullable',
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

            'OBQ' => 'required_if:tipo_operacion,Carga,Importación',
            'OBQ_agua' => 'required_if:tipo_operacion,Carga,Importación',
            'TCV_carga' => 'required_if:tipo_operacion,Carga,Importación',
            'GSV_carga' => 'required_if:tipo_operacion,Carga,Importación',
            'NSV_carga' => 'required_if:tipo_operacion,Carga,Importación',
            'TRV' => 'required_if:tipo_operacion,Carga,Importación',
            'TRV_ajustado' => 'required_if:tipo_operacion,Carga,Importación',

            'ROB' => 'required_if:tipo_operacion,Descarga,Exportación',
            'ROB_agua' => 'required_if:tipo_operacion,Descarga,Exportación',
            'TCV_descarga' => 'required_if:tipo_operacion,Descarga,Exportación',
            'GSV_descarga' => 'required_if:tipo_operacion,Descarga,Exportación',
            'NSV_descarga' => 'required_if:tipo_operacion,Descarga,Exportación',
            'TDV' => 'required_if:tipo_operacion,Descarga,Exportación',
            'TDV_ajustado' => 'required_if:tipo_operacion,Descarga,Exportación',

            'VEF' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate();

        $resumen = Resumen::find($this->resumen_id);

        if ($this->inspector == '') $this->inspector = 'SAMH';

        if ($this->nominacion) 
        {
            $nominacion = $this->nominacion->store('images/nominacion', 'public');
            Storage::disk('public')->delete($this->nominacion_existente);
        }
        else $nominacion = $resumen->nominacion;

        if ($this->embarque)
        {
            $embarque = $this->embarque->store('images/embarque', 'public');
            Storage::disk('public')->delete($this->embarque_existente);
        }
        else $embarque = $resumen->embarque;

        if ($this->cantidad)
        {
            $cantidad = $this->cantidad->store('images/certificados/cantidad', 'public');
            //Storage::disk('public')->delete($this->cantidad_existente);
        }
        else $cantidad = $resumen->cantidad;

        if ($this->calidad)
        {
            $calidad = $this->calidad->store('images/certificados/calidad', 'public');
            //Storage::disk('public')->delete($this->calidad_existente);
        }
        else $calidad = $resumen->calidad;

        if ($this->hoja_tiempo)
        {
            $hoja_tiempo = $this->hoja_tiempo->store('images/hoja_tiempo', 'public');
            //Storage::disk('public')->delete($this->hoja_tiempo_existente);
        }
        else $hoja_tiempo = $resumen->hoja_tiempo;

        if ($this->acta)
        {
            $acta = $this->acta->store('images/acta', 'public');
            //Storage::disk('public')->delete($this->acta);
        }
        else $acta = $resumen->acta;

        if ($this->ullage_inicial)
        {
            $ullage_inicial = $this->ullage_inicial->store('images/ullage/inicial', 'public');
            //Storage::disk('public')->delete($this->ullage_inicial);
        }
        else $ullage_inicial = $resumen->ullage_inicial;

        if ($this->ullage_final)
        {
            $ullage_final = $this->ullage_final->store('images/ullage/final', 'public');
            //Storage::disk('public')->delete($this->ullage_final);
        }
        else $ullage_final = $resumen->ullage_final;

        $resumen->update([
            'terminal_origen_id' => $this->terminal_origen_id,
            'terminal_destino_id' => $this->terminal_destino_id,
            'buque' => $this->buque,
            'nro_embarque' => $this->nro_embarque,
            'nro_viaje' => $this->nro_viaje,
            //'operacion_id' => $operacion_id,
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

            'nominacion' => $nominacion,
            'embarque' => $embarque,
            'cantidad' => $cantidad,
            'calidad' => $calidad,
            'hoja_tiempo' => $hoja_tiempo,
            'acta' => $acta,
            'ullage_inicial' => $ullage_inicial,
            'ullage_final' => $ullage_final,
        ]);

        return redirect()->route('resumen.index')->with('success', 'Resumen Actualizado Correctamente');
    }

    public function render()
    {
        $operacion = Resumen::find($this->resumen_id);
        $this->tipo_operacion = $operacion->operacion->nombre;

        $origenes = TerminalOrigen::orderBy('nombre')->get();
        $destinos = TerminalDestino::orderBy('nombre')->get();
        $productos = Producto::orderBy('nombre')->get();

        return view('livewire.resumen.edit', compact('operacion', 'origenes', 'destinos', 'productos'));
    }
}
