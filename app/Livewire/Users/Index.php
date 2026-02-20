<?php

namespace App\Livewire\Users;

use App\Models\TerminalOrigen;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $paginate = 10, $modalOpen = false, $borrarUser, $username;

    public $filters = [
        'name' => '',
        'email' => '',
        'cedula' => '',
        'nombre' => '',
        'fecha_inicio' => '',
        'fecha_fin' => '',
    ];

    public $columns = [
        'cedula' => true,
        'terminal' => true,
        'rol' => true,
        'fecha' => false,
    ];

    public function updatingFilters()
    {
        $this->resetPage();
    }

    public function modalBorrar($id)
    {
        $this->username = User::find($id)->name;

        $this->borrarUser = $id;

        $this->modalOpen = true;
    }

    public function borrar()
    {
        // 1. Buscamos y borramos
        $usuario = User::find($this->borrarUser);
        if ($usuario) {
            $usuario->delete();
        }

        // 2. Cerramos el modal (esto actualizará el x-show de Alpine automáticamente)
        $this->modalOpen = false;

        // 3. Opcional: Limpiar las variables para la próxima vez
        $this->reset(['borrarUser', 'username']);

        // 4. Opcional: Lanzar un mensaje de éxito (toast)
        $this->dispatch('notify', 
            message: 'Usuario eliminado correctamente', 
            icon: 'success',
            title: '¡Hecho!'
        );
    }

    public function crearUsuario()
    {
        return redirect()->route('users.create');
    }

    public function render()
    {
        $users = User::select('users.*', 'nombre')
            ->join('terminal_origens', 'terminal_origens.id', '=', 'users.terminal_origen_id')
        ;

        foreach ($this->filters as $column => $value)
        {
            if (!empty($value) && !in_array($column, ['fecha', 'fecha_inicio', 'fecha_fin']))
            {
                $users->where($column, 'like', '%' . $value . '%');
            }
        }

        // 1. Si el usuario llenó AMBOS campos de fecha
        if (!empty($this->filters['fecha_inicio']) && !empty($this->filters['fecha_fin'])) {
            $users->whereBetween('users.created_at', [
                $this->filters['fecha_inicio'] . ' 00:00:00', // Desde el primer segundo del inicio
                $this->filters['fecha_fin'] . ' 23:59:59'    // Hasta el último segundo del fin
            ]);
        } 
        // 2. Si solo llenó la fecha de inicio, filtramos ese día exacto
        elseif (!empty($this->filters['fecha_inicio'])) {
            $users->whereDate('users.created_at', $this->filters['fecha_inicio']);
        }

        $terminal = TerminalOrigen::orderBy('nombre')->get();

        return view('livewire.users.index', ['users' => $users->paginate($this->paginate), 'terminal' => $terminal]);
    }
}
