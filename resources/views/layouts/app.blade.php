<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? '' }} | {{ config('app.name') }}</title>

    <!--TODO: colocar los CDNs en local-->

    <!--Estilos-->
    

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!--Iconos-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Scripts -->
    @livewireScripts

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-zinc-900 dark:text-gray-100 transition-colors duration-300">
    <div class="flex h-screen overflow-hidden"> 
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-zinc-800 border-r dark:border-zinc-700 shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 h-screen flex flex-col">
    
            <div class="flex w-64 items-center justify-between px-4 py-6 flex-shrink-0 border border-gray-100 dark:border-zinc-700 mx-auto mb-2">
                <h2 class="text-[24px] font-bold text-center mx-auto w-full items-center">
                    <a href="{{ route('home') }}" class="block w-full text-center border-0">
                        <span class="text-yellow-400 dark:text-yellow-500">S</span><span class="text-blue-500 dark:text-blue-600">AR</span><span class="text-red-500 dark:text-red-600">F</span>
                    </a>
                </h2>
                <button id="close-sidebar" class="lg:hidden text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <nav class="flex-1 px-4 space-y-2 overflow-y-auto custom-scrollbar">
                <a href="{{ route('home') }}" class="flex items-center p-2 rounded-lg dark:text-gray-400 {{ request()->routeIs('home') ? 'bg-blue-500 text-white dark:text-white' : 'text-gray-600 hover:bg-blue-50 dark:hover:bg-zinc-700' }}">
                    <i class="fas fa-home mr-3"></i> Inicio
                </a>
                <a href="" class="flex items-center p-2 rounded-lg dark:text-gray-400 {{ request()->routeIs('resumen') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-blue-50 dark:hover:bg-zinc-700' }}">
                        <i class="fas fa-home mr-3"></i> Resumen
                </a>
                <a href="{{ route('users.index') }}" class="flex items-center p-2 rounded-lg dark:text-gray-400 {{ request()->routeIs('users.*') ? 'bg-blue-500 dark:text-white text-white' : 'text-gray-600 hover:bg-blue-50 dark:hover:bg-zinc-700' }}">
                    <i class="fas fa-users mr-3"></i> Usuarios
                </a>

                <div x-data="{ open: {{ request()->routeIs('auditoria.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open" 
                            class="w-full flex items-center justify-between p-2 rounded-lg transition-colors duration-200 group 
                                text-gray-600 dark:text-zinc-400 hover:bg-gray-100 dark:hover:bg-zinc-700"
                            :class="open ? 'bg-gray-50 dark:bg-zinc-800 text-gray-900 dark:text-zinc-100'  : ''">
                        
                        <div class="flex items-center">
                            <i class="fas fa-eye w-5 h-5 mr-3"></i> <span class="font-medium dark:hover:bg-zinc-700">Auditoría</span>
                        </div>

                        <i class="fas fa-chevron-down text-[10px] transition-transform duration-300"
                        :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="open" 
                        x-collapse.duration.700ms 
                        class="mt-1 ml-4 border-l border-gray-200 dark:border-zinc-700 space-y-1">
                        
                        <a href="#" class="block p-2 pl-6 text-sm rounded-lg transition-all flex items-center dark:text-gray-400 {{ request()->routeIs('creados') ? 'bg-blue-500 text-white dark:text-white' : 'text-gray-600 hover:bg-blue-50 dark:hover:bg-zinc-700' }}">
                            <i class="far fa-circle text-[8px] mr-3"></i> Registros Creados
                        </a>

                        <a href="#" class="block p-2 pl-6 text-sm rounded-lg transition-all flex items-center dark:text-gray-400 {{ request()->routeIs('editados') ? 'bg-blue-500 text-white dark:text-white' : 'text-gray-600 hover:bg-blue-50 dark:hover:bg-zinc-700' }}">
                            <i class="far fa-circle text-[8px] mr-3"></i> Registros Editados
                        </a>

                        <a href="#" class="block p-2 pl-6 text-sm rounded-lg transition-all flex items-center dark:text-gray-400 {{ request()->routeIs('eliminados') ? 'bg-blue-500 text-white dark:text-white' : 'text-gray-600 hover:bg-blue-50 dark:hover:bg-zinc-700' }}">
                            <i class="far fa-circle text-[8px] mr-3"></i> Registros Eliminados
                        </a>
                    </div>
                </div>
            </nav>
        </aside>

        <main class="flex-1 flex flex-col overflow-y-auto">
            <header class="bg-white shadow-sm p-4 flex justify-between items-center dark:bg-zinc-800 transition-colors duration-300">

                <button id="open-sidebar" class="lg:hidden text-gray-600 dark:text-gray-300">
                    <i class="fas fa-bars fa-lg"></i>
                </button>

                <div class="flex-1 mr-8 ml-4">
                    <img src="{{ asset('storage/images/cintillos/cintillo_claro.jpg') }}" 
                        alt="Cintillo Institucional" 
                        class="w-full h-auto block dark:hidden rounded-xl transition-all duration-300">

                    <img src="{{ asset('storage/images/cintillos/cintillo_oscuro.jpg') }}" 
                        alt="Cintillo Institucional" 
                        class="w-full h-auto hidden dark:block rounded-xl transition-all duration-300">
                </div>

                <div class="flex items-center space-x-4 ml-auto">
                    
                    <button id="theme-toggle" class="p-2 rounded-lg bg-gray-100 dark:bg-zinc-700 text-gray-600 dark:text-yellow-400 focus:outline-none hover:ring-2 hover:ring-gray-200 dark:hover:ring-zinc-600 transition-all">
                        <i id="theme-toggle-light-icon" class="fas fa-sun hidden"></i>
                        <i id="theme-toggle-dark-icon" class="fas fa-moon"></i>
                    </button>

                    <div class="h-6 w-px bg-gray-200 dark:bg-zinc-700"></div>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center space-x-2 text-sm font-medium text-gray-700 dark:text-zinc-200 hover:opacity-80 transition-all focus:outline-none">
                            <span>{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="open" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-64 rounded-xl shadow-lg py-2 bg-white dark:bg-zinc-800 border border-gray-100 dark:border-zinc-700 z-50"
                            style="display: none;">
                            
                            <div class="px-4 py-3 border-b border-gray-100 dark:border-zinc-700">
                                <p class="text-xs text-gray-500 dark:text-zinc-400 font-semibold uppercase tracking-wider">Perfil de Usuario</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-zinc-400 truncate">{{ auth()->user()->email }}</p>
                            </div>

                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 transition-colors {{ request()->routeIs('profile.edit') ? 'bg-blue-500 text-white dark:text-white' : 'text-gray-600 hover:bg-blue-50 dark:hover:bg-zinc-700 dark:text-zinc-300' }}">
                                    <i class="fas fa-user-circle mr-3 text-gray-400"></i> Mi Cuenta
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 transition-colors {{ request()->routeIs('profile.index') ? 'bg-blue-500 text-white dark:text-white' : 'text-gray-600 hover:bg-blue-50 dark:hover:bg-zinc-700 dark:text-zinc-300' }}">
                                    <i class="fas fa-cog mr-3 text-gray-400"></i> Configuración
                                </a>
                            </div>

                            <div class="border-t border-gray-100 dark:border-zinc-700 pt-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                        <i class="fas fa-sign-out-alt mr-3"></i> Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <section class="p-6 overflow-auto custom-scrollbar">
                {{ $slot }}
            </section>
        </main>

        <div id="sidebar-overlay" class="fixed inset-0 bg-black opacity-50 z-40 hidden lg:hidden"></div>
    </div>
</body>
</html>
