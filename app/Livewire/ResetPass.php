<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ResetPass extends Component
{
    public function resetPass($id)
    {
        $user = User::find($id);

        $user->update([
            'password' => Hash::make($user->cedula),
            'reset_password_sent_at' => null,
            'new_user' => '1',
        ]);

        $this->dispatch('notify', 
            message: 'Contraseña reseteada correctamente', 
            icon: 'success',
            title: '¡Hecho!'
        );
    }

    public function render()
    {
        $users = User::whereNotNull('reset_password_sent_at')->get();

        return view('livewire.reset-pass', compact('users'));
    }
}
