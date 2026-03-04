<?php

namespace App\Providers;

use App\Models\Cintillo;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });

        $cintilloOscuroModel = Cintillo::where('activo', '1')->where('modo', 'oscuro')->first();
        $cintilloClaroModel = Cintillo::where('activo', '1')->where('modo', 'claro')->first();

        if ($cintilloOscuroModel)
        {
            $cintilloOscuro = $cintilloOscuroModel->nombre;
        }
        else
        {
            $cintilloOscuro = '';
        }

        if ($cintilloClaroModel)
        {
            $cintilloClaro = $cintilloClaroModel->nombre;
        }
        else
        {
            $cintilloClaro = '';
        }
        
        View::share('cintilloOscuro', $cintilloOscuro);
        View::share('cintilloClaro', $cintilloClaro);
    }
}
