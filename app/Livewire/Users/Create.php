<?php

namespace App\Livewire\Users;

use App\Models\TerminalOrigen;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
{

    public $nombre, $cedula, $correo, $terminal_user, $rol;

    protected $rules = [
        'nombre' => 'required',
        'cedula' => 'required|integer|min:1000000|max:40000000|unique:users,cedula',
        'correo' => 'required|email|unique:users,email',
        'terminal_user' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        User::create([
            'name' => $this->nombre,
            'email' => $this->correo,
            'cedula' => $this->cedula,
            'terminal_origen_id' => $this->terminal_user,
            'password' => Hash::make($this->cedula),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');
    }

    public function render()
    {
        $terminales = TerminalOrigen::orderBy('nombre')->get();

        return view('livewire.users.create', compact('terminales'));
    }
}
