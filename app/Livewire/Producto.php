<?php

namespace App\Livewire;

use App\Models\Producto as ModelsProducto;
use Livewire\Component;

class Producto extends Component
{
    public $producto, $modalOpen = false, $accion, $ModelsProducto, $nombre;

    protected $rules = [
        'producto' => 'required|max:45|unique:productos,nombre',
    ];

    public function mount()
    {
        $this->ModelsProducto = ModelsProducto::class;
    }

    public function modalCrear()
    {
        $this->modalOpen = true;
        $this->accion = 'crear';
    }

    public function crear()
    {
        $this->validate();

        ModelsProducto::create([
            'nombre' => $this->producto
        ]);

        $this->modalOpen = false;

        $this->producto = '';

        $this->dispatch('notify', 
            message: 'Producto agregado con exito', 
            icon: 'success',
            title: '¡Hecho!'
        );
    }

    public function modalEditar(ModelsProducto $producto)
    {
        $this->modalOpen = true;
        $this->accion = 'editar';
        $this->producto = $producto->nombre;
        $this->ModelsProducto = $producto;
    }

    public function editar()
    {
        $this->validate();

        $this->ModelsProducto->update([
            'nombre' => $this->producto
        ]);

        $this->modalOpen = false;

        $this->producto = '';

        $this->dispatch('notify', 
            message: 'Producto actualizado con exito', 
            icon: 'success',
            title: '¡Hecho!'
        );
    }

    public function eliminar(ModelsProducto $producto)
    {
        if ($producto->resumenes()->count() > 0) {
            $this->dispatch('notify', 
                message: 'No se puede eliminar el producto porque tiene resumenes asociados', 
                icon: 'error',
                title: '¡Error!'
            );
            return;
        }

        $producto->delete();

        $this->dispatch('notify', 
            message: 'Producto eliminado con exito', 
            icon: 'success',
            title: '¡Hecho!'
        );
    }

    public function render()
    {
        $productos = ModelsProducto::orderBy('nombre')
        ->where('nombre', 'like', '%' . $this->nombre . '%')
        ->get();

        return view('livewire.producto', compact('productos'));
    }
}
