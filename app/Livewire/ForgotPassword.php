<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email;

    public function submit()
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $this->email)->first();

        if ($user)
        {
            if (!$user->reset_password_sent_at)
            {
                $user->reset_password_sent_at = now();
                $user->save();

                $this->email = '';

                $this->dispatch('notify', 
                    message: 'Solicitud de restablecimiento de contraseña enviada.', 
                    icon: 'success',
                    title: '¡Hecho!'
                );
            }
            else
            {
                $this->email = '';

                $this->dispatch('notify', 
                    message: 'Ya enviaste la solicitud.', 
                    icon: 'error',
                    title: 'Error'
                );
            }
        }
        else
        {
            $this->dispatch('notify', 
                message: 'No se encontró ningún usuario con ese correo electrónico.', 
                icon: 'error',
                title: 'Error'
            );
        }
    }

    public function render()
    {
        return view('livewire.forgot-password');
    }
}
