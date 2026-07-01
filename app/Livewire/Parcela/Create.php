<?php

namespace App\Livewire\Parcela;

use App\Models\Cargamento;
use App\Models\FormField;
use App\Models\Producto;
use App\Models\TerminalDestino;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    public $cargamentoId;

    public $producto_id, $volumen, $TOV, $GOV, $GSV, $NSV, $TCV, $sediment_water, $free_water, $agua_sedimento, $azufre, $temp, $API, $VEF, $tipo_operacion, $cantidad_determinada, $validaciones = [];

    public $terminales_destinos_ids = [];
    public $rutas_destinos = [];

    //carga
    public $OBQ, $OBQ_agua, $TCV_carga, $GSV_carga, $NSV_carga, $TRV, $TRV_ajustado;

    //descarga
    public $ROB, $ROB_agua, $TCV_descarga, $GSV_descarga, $NSV_descarga, $TDV, $TDV_ajustado;

    public function mount()
    {
        $this->tipo_operacion = Str::slug(Cargamento::find($this->cargamentoId)->operacion->nombre);

        $terminales_cargamento = Cargamento::find($this->cargamentoId)->ruta->terminalDestinos;

        $this->rutas_destinos = $terminales_cargamento->pluck('id')->toArray();

        $this->validaciones = FormField::pluck('is_required', 'field_name')->toArray();
    }

    public function rules()
    {
        return [
            'producto_id' => ($this->validaciones['producto'] ?? false) ? 'required' : 'nullable',
            'terminales_destinos_ids' => ($this->validaciones['terminal_destino'] ?? false) ? 'required' : 'nullable',
            'volumen' => [($this->validaciones['volumen'] ?? false) ? 'required' : 'nullable', 'integer', 'max:999999999', 'min:100'],
            'cantidad_determinada' => ($this->validaciones['cantidad_determinada'] ?? false) ? 'required' : 'nullable',

            'TOV' => 'required|decimal:2|max:9999999.99|min:1.00',
            'GOV' => 'required|decimal:2|max:9999999.99|min:1.00',
            'GSV' => 'required|decimal:2|max:9999999.99|min:1.00',
            'NSV' => 'required|decimal:2|max:9999999.99|min:1.00',
            'TCV' => 'required|decimal:2|max:9999999.99|min:1.00',
            'sediment_water' => 'required|decimal:2|max:999999.99|min:0.00',
            'free_water' => 'required|decimal:2|max:999999.99|min:0.00',
            'agua_sedimento' => 'required|decimal:3|max:9.999|min:0.000',
            'temp' => 'required|decimal:1|max:999.9|min:-999.9',
            'API' => 'required|decimal:1|max:999.9|min:0.0',
            'azufre' => 'required|decimal:2|max:9.99|min:0.00',

            'OBQ' => ['nullable', 'required_if:tipo_operacion,carga,exportacion', 'decimal:2', 'max:9999999.99'],
            'OBQ_agua' => ['nullable', 'required_if:tipo_operacion,carga,exportacion', 'decimal:2', 'max:9999999.99'],
            'TCV_carga' => ['nullable', 'required_if:tipo_operacion,carga,exportacion', 'decimal:2', 'max:9999999.99'],
            'GSV_carga' => ['nullable', 'required_if:tipo_operacion,carga,exportacion', 'decimal:2', 'max:9999999.99'],
            'NSV_carga' => ['nullable', 'required_if:tipo_operacion,carga,exportacion', 'decimal:2', 'max:9999999.99'],
            'TRV' => ['nullable', 'required_if:tipo_operacion,carga,exportacion', 'decimal:2', 'max:9999999.99'],
            'TRV_ajustado' => ['nullable', 'required_if:tipo_operacion,carga,exportacion', 'decimal:2', 'max:9999999.99'],
            'ROB' => ['nullable', 'required_if:tipo_operacion,descarga,importacion', 'decimal:2', 'max:9999999.99'],
            'ROB_agua' => ['nullable', 'required_if:tipo_operacion,descarga,importacion', 'decimal:2', 'max:9999999.99'],
            'TCV_descarga' => ['nullable', 'required_if:tipo_operacion,descarga,importacion', 'decimal:2', 'max:9999999.99'],
            'GSV_descarga' => ['nullable', 'required_if:tipo_operacion,descarga,importacion', 'decimal:2', 'max:9999999.99'],
            'NSV_descarga' => ['nullable', 'required_if:tipo_operacion,descarga,importacion', 'decimal:2', 'max:9999999.99'],
            'TDV' => ['nullable', 'required_if:tipo_operacion,descarga,importacion', 'decimal:2', 'max:9999999.99'],
            'TDV_ajustado' => ['nullable', 'required_if:tipo_operacion,descarga,importacion', 'decimal:2', 'max:9999999.99'],
            'VEF' => 'required|decimal:4|max:9.9999|min:0.0001',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        if ($this->producto_id == '') $this->producto_id = null;
        if ($this->volumen == '') $this->volumen = null;
        if ($this->cantidad_determinada == '') $this->cantidad_determinada = null;

        $cargamento = Cargamento::find($this->cargamentoId);

        $cargamento->parcelas()->create([
            'producto_id' => $this->producto_id,
            'volumen' => $this->volumen,
            'cantidad_determinada' => $this->cantidad_determinada,

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
        ])->terminalDestinos()->sync($this->terminales_destinos_ids);

        return redirect()->route('cargamento.index')->with('success', 'Parcela Agregada Correctamente');
    }

    public function render()
    {
        $productos = Producto::orderBy('nombre')->get();
        $destinos = TerminalDestino::orderBy('nombre')->whereIn('id', $this->rutas_destinos)->get();

        return view('livewire.parcela.create', compact('productos', 'destinos'));
    }
}
