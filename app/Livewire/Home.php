<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public function disp()
    {
        $this->dispatch('notify', 
                message: 'El Rola del Norte.', 
                icon: 'success',
                title: '¡Hecho!'
            );
    }

    public function render()
    {
        return view('livewire.home');
    }
}
