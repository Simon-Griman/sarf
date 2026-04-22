<?php

namespace App\Listeners;

use App\Models\UserLogin;
use Jenssegers\Agent\Agent;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user = $event->user;
        $request = request();
        $agent = new Agent();
        
        $agent->setUserAgent($request->header('User-Agent'));

        $device = $agent->platform() . ' en ' . ($agent->isDesktop() ? 'Escritorio' : ($agent->isTablet() ? 'Tablet' : 'Movil'));

        $browser = $agent->browser();

        UserLogin::create([
            'user_id' => $user->id,
            'ip_address' => $request->ip(),
            'sistema' => $device,
            'navegador' => $browser,
        ]);
    }
}
