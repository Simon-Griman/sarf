<?php

namespace App\Livewire\Auditoria;

use App\Models\User;
use App\Models\UserLogin;
use Livewire\Component;
use Livewire\WithPagination;

class Sesiones extends Component
{
    use WithPagination;

    public $buscar, $log_usuario=[], $name, $modalOpen=false;

    public function ver($id)
    {
        $this->log_usuario = UserLogin::where('user_id', $id)->orderBy('login_at', 'desc')->get();

        $this->name = User::find($id)->name;

        $this->modalOpen = true;
    }

    public function render()
    {
        $sesiones = UserLogin::whereIn('id', function ($query) {
        $query->selectRaw('max(id)')
            ->from('user_logins')
            ->groupBy('user_id');
        })
        ->with('user')
        ->whereHas('user', function ($query) {
            $query->where('name', 'like', '%' . $this->buscar . '%');
        })
        ->orderBy('login_at', 'desc')
        ->paginate();

        return view('livewire.auditoria.sesiones', compact('sesiones'));
    }
}
