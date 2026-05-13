<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CambiarClave extends Component
{
    public $password, $confirPass;

    protected $rules = [
        'password' => 'required|min:8|max:32',
        'confirPass' => 'required|same:password',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function changePass()
    {
        $this->validate();

        $user = User::find(auth()->id());

        $user->update([
            'password' => Hash::make($this->password),
            'new_user' => '0',
        ]);

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.cambiar-clave');
    }
}
