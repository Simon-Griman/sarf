<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? '' }} | {{ config('app.name') }}</title>

        <!--Estilos-->
        

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!--Iconos-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="dashboard-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h3>SARF</h3>
            </div>
            <nav class="sidebar-menu">
                <ul>
                    <li>
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}"><i class="fas fa-home"></i> Inicio</a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fas fa-newspaper"></i> Resumenes</a>
                    </li>
                    <li>
                        <a href="" class="{{ request()->routeIs('users') ? 'active' : '' }}"><i class="fas fa-users"></i> Usuarios</a>
                    </li>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="logout-btn" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Salir
                    </a>
                </form>
            </div>
        </aside>

        <main class="main-content">
            <header class="top-nav">
                <img src="{{ asset('storage/images/cintillos/cintillo_ayacucho.jpg') }}" alt="">
                <div class="perfil-nav">
                    @php $user = Illuminate\Support\Facades\Auth::id() @endphp
                    {{ App\Models\User::find($user)->name }}
                </div>
            </header>
            <section class="content-area">
                {{ $slot }}
            </section>
        </main>
    </body>
</html>
