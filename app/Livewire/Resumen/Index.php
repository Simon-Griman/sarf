<?php

namespace App\Livewire\Resumen;

use App\Models\Resumen;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $paginate = 10;

    public $columns = [
        'origen' => true,
        'destino' => true,
        'buque' => true,
        'nro_embarque' => true,
        'nro_viaje' => true,
        'operacion' => true,
        'producto' => true,
        'volumen' => false,
        'fecha' => false,
    ];

    public function render()
    {
        $resumenes = Resumen::orderBy('created_at')->paginate($this->paginate);

        return view('livewire.resumen.index', compact('resumenes'));
    }
}
