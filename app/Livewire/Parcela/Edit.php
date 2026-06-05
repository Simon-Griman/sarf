<?php

namespace App\Livewire\Parcela;

use App\Models\Cargamento;
use App\Models\Parcela;
use App\Models\Producto;
use App\Models\TerminalDestino;
use Illuminate\Support\Str;
use Livewire\Component;

class Edit extends Component
{
    public $parcelaId;

    public $producto_id, $volumen, $TOV, $GOV, $GSV, $NSV, $TCV, $sediment_water, $free_water, $agua_sedimento, $azufre, $temp, $API, $VEF, $tipo_operacion;

    public $terminales_destinos_ids = [];

    //carga
    public $OBQ, $OBQ_agua, $TCV_carga, $GSV_carga, $NSV_carga, $TRV, $TRV_ajustado;

    //descarga
    public $ROB, $ROB_agua, $TCV_descarga, $GSV_descarga, $NSV_descarga, $TDV, $TDV_ajustado;

    public function mount()
    {
        $parcela = Parcela::find($this->parcelaId);

        $this->tipo_operacion = Str::slug($parcela->cargamento->operacion->nombre);

        $this->producto_id = $parcela->producto_id;
        $this->volumen = $parcela->volumen;
        $this->TOV = $parcela->TOV;
        $this->GOV = $parcela->GOV;
        $this->GSV = $parcela->GSV;
        $this->NSV = $parcela->NSV;
        $this->TCV = $parcela->TCV;
        $this->sediment_water = $parcela->sediment_water;
        $this->free_water = $parcela->free_water;
        $this->agua_sedimento = $parcela->agua_sedimento;
        $this->azufre = $parcela->azufre;
        $this->temp = $parcela->temp;
        $this->API = $parcela->API;
        $this->VEF = $parcela->VEF;
        $this->OBQ = $parcela->OBQ;
        $this->OBQ_agua = $parcela->OBQ_agua;
        $this->TCV_carga = $parcela->TCV_carga;
        $this->GSV_carga = $parcela->GSV_carga;
        $this->NSV_carga = $parcela->NSV_carga;
        $this->TRV = $parcela->TRV;
        $this->TRV_ajustado = $parcela->TRV_ajustado;
        $this->ROB = $parcela->ROB;
        $this->ROB_agua = $parcela->ROB_agua;
        $this->TCV_descarga = $parcela->TCV_descarga;
        $this->GSV_descarga = $parcela->GSV_descarga;
        $this->NSV_descarga = $parcela->NSV_descarga;
        $this->TDV = $parcela->TDV;
        $this->TDV_ajustado = $parcela->TDV_ajustado;

        $this->terminales_destinos_ids = $parcela->terminalDestinos()->pluck('terminal_destino_id')->toArray();
    }

    public function rules()
    {
        return [
            'producto_id' => 'required',
            'terminales_destinos_ids' => 'required',
            'volumen' => 'required|integer|max:999999999999|min:100',
            'TOV' => 'required|decimal:2|max:999999.99|min:1.00',
            'GOV' => 'required|decimal:2|max:999999.99|min:1.00',
            'GSV' => 'required|decimal:2|max:999999.99|min:1.00',
            'NSV' => 'required|decimal:2|max:999999.99|min:1.00',
            'TCV' => 'required|decimal:2|max:999999.99|min:1.00',
            'sediment_water' => 'required|decimal:2|max:9999.99|min:0.00',
            'free_water' => 'required|decimal:2|max:9999.99|min:0.00',
            'agua_sedimento' => 'required|decimal:2|max:9999.99|min:0.00',
            'temp' => 'required|decimal:1|max:9999',
            'API' => 'required|decimal:1|max:9999',
            'azufre' => 'required|decimal:3|max:9999',

            'OBQ' => ['nullable', 'required_if:tipo_operacion,carga,importacion', 'decimal:2', 'max:999999'],
            'OBQ_agua' => ['nullable', 'required_if:tipo_operacion,carga,importacion', 'decimal:2', 'max:999999'],
            'TCV_carga' => ['nullable', 'required_if:tipo_operacion,carga,importacion', 'decimal:2', 'max:999999'],
            'GSV_carga' => ['nullable', 'required_if:tipo_operacion,carga,importacion', 'decimal:2', 'max:999999'],
            'NSV_carga' => ['nullable', 'required_if:tipo_operacion,carga,importacion', 'decimal:2', 'max:999999'],
            'TRV' => ['nullable', 'required_if:tipo_operacion,carga,importacion', 'decimal:2', 'max:999999'],
            'TRV_ajustado' => ['nullable', 'required_if:tipo_operacion,carga,importacion', 'decimal:2', 'max:999999'],

            'ROB' => ['nullable', 'required_if:tipo_operacion,descarga,exportacion', 'decimal:2', 'max:999999'],
            'ROB_agua' => ['nullable', 'required_if:tipo_operacion,descarga,exportacion', 'decimal:2', 'max:999999'],
            'TCV_descarga' => ['nullable', 'required_if:tipo_operacion,descarga,exportacion', 'decimal:2', 'max:999999'],
            'GSV_descarga' => ['nullable', 'required_if:tipo_operacion,descarga,exportacion', 'decimal:2', 'max:999999'],
            'NSV_descarga' => ['nullable', 'required_if:tipo_operacion,descarga,exportacion', 'decimal:2', 'max:999999'],
            'TDV' => ['nullable', 'required_if:tipo_operacion,descarga,exportacion', 'decimal:2', 'max:999999'],
            'TDV_ajustado' => ['nullable', 'required_if:tipo_operacion,descarga,exportacion', 'decimal:2', 'max:999999'],
            'VEF' => 'required|decimal:4|max:10.0000|min:0.0001',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        $parcela = Parcela::find($this->parcelaId);

        $parcela->update([
            'producto_id' => $this->producto_id,
            'volumen' => $this->volumen,
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
        ]);

        $parcela->terminalDestinos()->sync($this->terminales_destinos_ids);

        return redirect()->route('cargamento.index')->with('success', 'Parcela Editada Correctamente');
    }

    public function render()
    {
        $productos = Producto::orderBy('nombre')->get();
        $destinos = TerminalDestino::orderBy('nombre')->get();

        return view('livewire.parcela.edit', compact('productos', 'destinos'));
    }
}
