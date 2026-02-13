<?php

namespace App\Livewire\Users;

use App\Models\TerminalOrigen;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $user_id;

    public $nombre, $cedula, $correo, $terminal_user;

    protected $rules = [
        'nombre' => 'required',
        'cedula' => 'required',
        'correo' => 'required|unique:users,email',
    ];

    //TODO: instalar los idiomas

    public function mount()
    {
        $user = User::find($this->user_id);

        $this->nombre = $user->name;
        $this->cedula = $user->cedula;
        $this->correo = $user->email;
        $this->terminal_user = $user->terminal_origen_id;
    }

    public function update()
    {
        $this->validate();
    }

    public function render()
    {
        $user = User::find($this->user_id);

        $terminales = TerminalOrigen::orderBy('nombre')->get();

        return view('livewire.users.edit', compact('user', 'terminales'));
    }
}
