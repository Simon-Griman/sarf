<?php

namespace App\Providers;

use App\Models\Cintillo;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login; // El evento nativo de Laravel
use App\Listeners\LogSuccessfulLogin; // Tu listener
use Illuminate\Support\Facades\Schema;

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

        if (Schema::hasTable('cintillos')) {
        
            $cintilloOscuroModel = Cintillo::where('activo', '1')->where('modo', 'oscuro')->first();
            $cintilloClaroModel = Cintillo::where('activo', '1')->where('modo', 'claro')->first();

            View::share('cintilloOscuro', $cintilloOscuroModel->nombre ?? '');
            View::share('cintilloClaro', $cintilloClaroModel->nombre ?? '');
        } 

        else {
            // Valores por defecto si la tabla no existe aún (durante migraciones)
            View::share('cintilloOscuro', '');
            View::share('cintilloClaro', '');
        }

        

        // Registramos el Listener para el evento Login
        Event::listen(
            Login::class,
            LogSuccessfulLogin::class
        );
    }
}
