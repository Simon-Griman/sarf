<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $users = User::orderBy('created_at')->get();

        return view('livewire.users.index', compact('users'));
    }
}
