<?php

namespace App\Livewire;

use App\Models\Cintillo;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Cintillos extends Component
{
    use WithFileUploads;

    public $cintillo, $cintillo_borrar, $id_borrar, $cintillo_activar, $id_activar, $modalOpen = false, $mensaje, $titulo, $boton, $accion, $modo;

    public function modalUp()
    {
        $this->accion = 'up';

        $this->boton = 'Crear';

        $this->titulo = 'Nuevo Cintillo';

        $this->mensaje = 'Recuerda que el cintillo debe ser una imagen en formato JPEG o JPG, con un tamaño máximo de 2MB.';

        $this->reset('cintillo');
        $this->modalOpen = true;
    }

    public function up()
    {
        $this->validate(['cintillo' => 'required|image|mimes:jpeg,jpg|max:2048']);

        $nombre = $this->cintillo->store('images/cintillos', 'public');

        Cintillo::create([
            'nombre' => $nombre,
        ]);

        $this->reset('cintillo');

        $this->modalOpen = false;

        $this->dispatch('notify', 
            message: 'Cintillo cargado correctamente', 
            icon: 'success',
            title: '¡Hecho!'
        );
    }

    public function modalActivar($id)
    {
        $this->accion = 'activar';

        $this->boton = 'Activar';

        $this->titulo = 'Activar Cintillo';

        $this->mensaje = '¿Realmente quieres activar este cintillo?';

        $this->id_activar = $id;
        $this->cintillo_activar = Cintillo::find($id)->nombre;

        $this->modalOpen = true;
    }

    public function activar()
    {
        $this->validate(['modo' => 'required']);

        Cintillo::where('activo', '1')->where('modo', $this->modo)->update(['activo' => '0', 'modo' => null]);

        $cintillo = Cintillo::find($this->id_activar);

        if ($cintillo->activo == 1)
        {
            $this->dispatch('notify', 
                message: 'El cintillo ya está activo', 
                icon: 'error',
                title: '¡Error!'
            );

            $this->modalOpen = false;

            return;
        }

        $cintillo->update([
            'activo' => '1',
            'modo' => $this->modo,
        ]);

        $this->dispatch('notify', 
            message: 'Cintillo activado correctamente', 
            icon: 'success',
            title: '¡Cintillo Activo!'
        );

        $this->reset('cintillo');

        $this->modalOpen = false;
    }

    public function confirBorrar($id)
    {
        $this->accion = 'borrar';

        $this->boton = 'Borrar';

        $this->titulo = 'Borrar Cintillo';

        $this->mensaje = '¿Realmente quieres borrar este cintillo?';

        $this->id_borrar = $id;
        $this->cintillo_borrar = Cintillo::find($id)->nombre;

        $this->modalOpen = true;
    }

    public function borrar()
    {
        $cintillo = Cintillo::find($this->id_borrar);

        if ($cintillo->activo == 1)
        {
            $this->dispatch('notify', 
                message: 'No se puede borrar el cintillo activo', 
                icon: 'error',
                title: '¡Cintillo Activo!'
            );
        }

        else
        {
            Storage::disk('public')->delete($this->cintillo_borrar);

            $cintillo->delete();
        
            $this->dispatch('notify', 
                message: 'Cintillo borrado correctamente', 
                icon: 'info',
                title: '¡Hecho!'
            );
        }

        $this->modalOpen = false;
    }

    public function render()
    {
        $cintillos = Cintillo::all();

        return view('livewire.cintillos', compact('cintillos'));
    }
}
