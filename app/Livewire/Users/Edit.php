<?php

namespace App\Livewire\Users;

use App\Models\TerminalOrigen;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public $user_id;

    public $nombre, $cedula, $correo, $terminal_user, $rol;

    public $selectedRoles = [];

    protected function rules()
    {
        return [
            'nombre' => 'required',
            'cedula' => 'required|integer|min:1000000|max:40000000|unique:users,cedula,' . $this->user_id,
            'correo' => 'required|email|unique:users,email,' . $this->user_id,
            'terminal_user' => 'required',
        ];
    }

    public function mount()
    {
        $user = User::find($this->user_id);

        $this->nombre = $user->name;
        $this->cedula = $user->cedula;
        $this->correo = $user->email;
        $this->terminal_user = $user->terminal_origen_id;

        $this->selectedRoles = $user->roles->pluck('name')->toArray();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate();

        $user = User::find($this->user_id);

        if ($user->roles->max('peso') >= auth()->user()->roles->max('peso')) return redirect()->route('users.index')->with('error', 'No puedes editar un usuario con el mismo o mayor rol que tú');

        $user->update([
            'name' => $this->nombre,
            'email' => $this->correo,
            'cedula' => $this->cedula,
            'terminal_origen_id' => $this->terminal_user,
        ]);

        $user->syncRoles($this->selectedRoles);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function resetPassword()
    {
        $user = User::find($this->user_id);

        $user->update([
            'password' => Hash::make($user->cedula),
        ]);

        return redirect()->route('users.index')->with('success', 'Contraseña reseteada correctamente');
    }

    public function render()
    {
        $user = User::find($this->user_id);

        $terminales = TerminalOrigen::orderBy('nombre')->get();

        $roles = Role::all();

        return view('livewire.users.edit', compact('user', 'terminales', 'roles'));
    }
}
