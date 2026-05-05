<?php

namespace App\Livewire\Users;

use App\Models\TerminalOrigen;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Create extends Component
{

    public $nombre, $cedula, $correo, $terminal_user, $rol;

    public $selectedRoles = [];

    public function rules()
    {
        return [
            'nombre' => 'required',
            'cedula' => ['required', 'integer', 'min:1000000', 'max:40000000', Rule::unique('users', 'cedula')->whereNull('deleted_at')],
            'correo' => ['required', 'email', Rule::unique('users', 'email')->whereNull('deleted_at')],
            'terminal_user' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->nombre,
            'email' => $this->correo,
            'cedula' => $this->cedula,
            'terminal_origen_id' => $this->terminal_user,
            'password' => Hash::make($this->cedula),
        ]);

        $user->syncRoles($this->selectedRoles);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');
    }

    public function render()
    {
        $terminales = TerminalOrigen::orderBy('nombre')->get();

        $roles = Role::all();

        return view('livewire.users.create', compact('terminales', 'roles'));
    }
}
