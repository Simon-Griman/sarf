<div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
    <x-card class="overflow-visible">
        <form wire:submit.prevent="@if($is_update) update @else save @endif">
            <div class="form-group mb-6">
                <label for="nro_ruta" class="block font-medium text-gray-800 dark:text-white">Número de Ruta:<span class="text-red-500">*</span></label>
                <x-form-text-input type="number" id="nro_ruta" name="nro_ruta" wire:model="nro_ruta" class="form-control w-full mt-2" />
            </div>

            <div class="form-group mb-6">
                <label for="buque" class="block font-medium text-gray-800 dark:text-white">Buque:<span class="text-red-500">*</span></label>
                <x-form-text-input type="text" id="buque" name="buque" wire:model="buque" class="form-control w-full mt-2" />
            </div>

            <div class="form-group mb-6">
                <label for="terminal_origen_id" class="block font-medium text-gray-800 dark:text-white">Terminal de Origen:<span class="text-red-500">*</span></label>
                <x-form-select id="terminal_origen_id" name="terminal_origen_id" wire:model="terminal_origen_id" class="form-control w-full mt-2">
                    <option value="">-- Seleccionar --</option>
                    @foreach($origenes as $origen)
                        <option value="{{ $origen->id }}">{{ $origen->nombre }}</option>
                    @endforeach
                </x-form-select>
            </div>

            <div class="sm:col-span-2 mb-6">
                <label class="block font-medium text-gray-800 dark:text-white mb-2">
                    Terminales de Destino:<span class="text-red-500">*</span>
                </label>
                
                <div class="p-3 bg-white/5 dark:bg-zinc-700 border border-zinc-500 rounded-md max-h-64 overflow-y-auto custom-scrollbar space-y-1">
                    @foreach($destinos as $destino)
                        <label class="flex items-center px-3 py-2 hover:bg-zinc-200 dark:hover:bg-zinc-800 rounded-md cursor-pointer group transition-colors">
                            <input 
                                type="checkbox" 
                                value="{{ $destino->id }}" 
                                wire:model="terminal_destinos_ids" 
                                id="destino_{{ $destino->id }}"
                                class="w-4 h-4 rounded border-zinc-600 bg-zinc-200 dark:bg-zinc-800 text-blue-600 focus:ring-blue-500 focus:ring-offset-zinc-700"
                            >
                            <span class="ml-3 text-sm text-gray-800 dark:text-gray-300 group-hover:text-gray-800 dark:group-hover:text-white">
                                {{ $destino->nombre }}
                            </span>
                        </label>
                    @endforeach
                </div>
                @error('terminal_destinos_ids') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <x-primary-button type="submit" class="btn btn-primary">Guardar</x-primary-button>
        </form>
    </x-card>

    <x-card class="w-full">
        <form wire:submit.prevent="buscar">
            <h1 class="mb-4">Buscar Ruta</h1>
            <x-form-text-input type="number" wire:model="buscarRuta" placeholder="Ingrese el número de ruta" class="form-control mb-3" />

            @if($ruta)
                <div class="mt-4 bg-gray-50 dark:bg-zinc-800/50 border border-gray-200 dark:border-zinc-700 rounded-xl p-5 shadow-sm space-y-4 transition-all duration-300 animate-fade-in">
                    
                    <!-- Encabezado con el Número de Ruta -->
                    <div class="flex items-center justify-between border-b border-gray-200 dark:border-zinc-700 pb-3">
                        <h2 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-zinc-400">
                            Detalles del Recorrido
                        </h2>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300 border border-blue-200 dark:border-blue-800/50">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L16 4m0 13V4m0 0L9 7"></path>
                            </svg>
                            Ruta N° {{ $ruta->nro_ruta }}
                        </span>
                    </div>

                    <!-- Flujo de Terminales (Origen -> Destinos) -->
                    <div class="space-y-4">

                        <!-- Buque -->
                        <div class="flex items-start gap-3 mb-6">
                            <div class="flex flex-col items-center">
                                <div class="flex items-center justify-center w-6 h-6 rounded-full bg-amber-500 text-white text-xs font-bold ring-4 ring-amber-100 dark:ring-amber-950/50">
                                    B
                                </div>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-400 dark:text-zinc-500 uppercase">Buque</p>
                                <p class="text-base font-semibold text-gray-800 dark:text-white mt-0.5">
                                    {{ $ruta->buque ?? 'No asignado' }}
                                </p>
                            </div>
                        </div>
                        
                        <!-- Terminal Origen -->
                        <div class="flex items-start gap-3">
                            <div class="flex flex-col items-center">
                                <div class="flex items-center justify-center w-6 h-6 rounded-full bg-emerald-500 text-white text-xs font-bold ring-4 ring-emerald-100 dark:ring-emerald-950/50">
                                    O
                                </div>
                                <!-- Línea vertical conectora -->
                                <div class="w-0.5 h-12 bg-gradient-to-b from-emerald-500 to-blue-500 my-1"></div>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-400 dark:text-zinc-500 uppercase">Terminal de Origen</p>
                                <p class="text-base font-semibold text-gray-800 dark:text-white mt-0.5">
                                    {{ $ruta->terminalOrigen?->nombre ?? 'No asignado' }}
                                </p>
                            </div>
                        </div>

                        <!-- Terminales Destino -->
                        <div class="flex items-start gap-3">
                            <div class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-500 text-white text-xs font-bold ring-4 ring-blue-100 dark:ring-blue-950/50">
                                D
                            </div>
                            <div class="w-full">
                                <p class="text-xs font-medium text-gray-400 dark:text-zinc-500 uppercase">Terminales de Destino</p>
                                
                                @if($ruta->terminalDestinos && $ruta->terminalDestinos->count() > 0)
                                    <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        @foreach($ruta->terminalDestinos as $destino)
                                            <div class="flex items-center gap-2 px-3 py-2 bg-white dark:bg-zinc-800 border border-gray-100 dark:border-zinc-700/60 rounded-lg shadow-sm">
                                                <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                <span class="text-sm font-medium text-gray-700 dark:text-zinc-200">
                                                    {{ $destino->nombre }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500 italic mt-1">No hay destinos registrados para esta ruta.</p>
                                @endif
                            </div>
                        </div>
                        <div class="text-center pt-4">
                            <x-warning-button type="button" wire:click="edit({{ $ruta->id }})">Editar</x-warning-button>
                            <x-danger-button type="button" wire:click="confirmDelete({{ $ruta->id }})">Eliminar</x-danger-button>
                        </div>
                    </div>
                </div>
            @elseif(!empty($buscarRuta))
                <!-- Alerta de "No encontrado" estilizada -->
                <div class="mt-4 flex items-center gap-3 p-4 bg-amber-50 dark:bg-amber-950/20 border border-amber-200 dark:border-amber-900/50 rounded-xl text-amber-800 dark:text-amber-400">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <p class="text-sm font-medium">
                        No se encontró ninguna ruta activa con el número <span class="font-bold underline">{{ $buscarRuta }}</span>.
                    </p>
                </div>
            @endif

            <x-primary-button type="submit" class="btn btn-primary mt-3">Buscar</x-primary-button>
        </form>
    </x-card>

    <div 
        x-data="{ open: false, name: 'delete-route-modal' }"
        x-on:open-modal.window="if ($event.detail.name === name) open = true"
        x-on:close-modal.window="if ($event.detail.name === name) open = false"
        x-on:keydown.escape.window="open = false"
        x-show="open"
        class="fixed inset-0 z-50 overflow-y-auto"
        style="display: none;"
    >
        <div 
            x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/60 backdrop-blur-sm"
            @click="open = false"
        ></div>

        <div class="flex min-h-screen items-center justify-center p-4 text-center">
            <div 
                x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative w-full max-w-md transform overflow-hidden rounded-xl bg-white p-6 text-left shadow-xl transition-all dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700"
            >
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 dark:bg-red-950/50 text-red-600 dark:text-red-400 mb-4">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>

                <div class="text-center">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                        ¿Eliminar esta ruta?
                    </h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-zinc-400">
                        Esta acción es irreversible. Se eliminará el registro de la ruta y se desvincularán sus terminales de destino asociadas.
                    </p>
                </div>

                <div class="mt-6 flex justify-center gap-3">
                    <button 
                        type="button" 
                        @click="open = false" 
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 dark:bg-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-600 rounded-lg transition-colors focus:outline-none"
                    >
                        Cancelar
                    </button>

                    <button 
                        type="button" 
                        wire:click="delete" 
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-800 rounded-lg transition-colors focus:outline-none shadow-sm shadow-red-600/20"
                    >
                        Sí, eliminar ruta
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
