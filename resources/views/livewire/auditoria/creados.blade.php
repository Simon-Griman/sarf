<div>
    <x-table>
        <x-slot name="thead">
            <tr>
                <th class="p-2"><x-text-input placeholder="Buscar:" wire:model.live.debounce.300ms="nombre"></x-text-input></th>
                
                <th class="p-2"><x-text-input placeholder="Buscar:" wire:model.live.debounce.300ms="tabla"></x-text-input></th>
                
                <th class="p-2"><x-text-input type="number" placeholder="Buscar:" wire:model.live.debounce.300ms="registro_id"></x-text-input></th>

                <th class="p-2"><x-text-input type="date" placeholder="Buscar:" wire:model.live.debounce.300ms="fecha_hora"></x-text-input></th>
                <th></th>
            </tr>
            <tr>
                <th class="text-left px-4 py-4">Usuario</th>
                <th class="text-left pl-4">Tabla</th>
                <th class="text-left pl-4">ID</th>
                <th class="text-left pl-4">Fecha y Hora</th>
                <th class="text-left px-4">Acciones</th>
            </tr>
        </x-slot>

            @foreach ($creados as $creado)
                <tr class="hover:bg-gray-100 dark:hover:bg-zinc-700/50 transition-colors duration-200 text-gray-700 dark:text-gray-200">
                    <td class="py-2 px-4">{{ $creado->name }}</td>
                    <td class="pl-4">{{ $creado->model_name }}</td>
                    <td class="pl-4">{{ $creado->model_id }}</td>
                    <td class="pl-4">
                        @if ($fecha->parse($creado->fecha)->gt(now()->subDay()))
                            {{ $fecha->create($creado->fecha)->diffForHumans() }}
                        @else
                            {{ $fecha->create($creado->fecha)->format('d/m/Y H:i:s') }}
                        @endif
                    </td>
                    <td class="px-4"><x-edit-button wire:click="ver({{ $creado->model_id }}, '{{ $creado->model_name }}')"><i class="fas fa-eye"></i> Ver Registro</x-edit-button></td>
                </tr>
            @endforeach
        
        <x-slot name="tfoot">
            <td colspan="6" class="p-2">{{ $creados->links() }}</td>
        </x-slot>
    </x-table>
    
    <div x-data="{ open: @entangle('modalOpen') }" 
    x-show="open" 
    class="relative z-10" 
    aria-labelledby="modal-title" 
    role="dialog" 
    aria-modal="true"
    style="display: none;"> 
    
        <div x-show="open" 
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            class="fixed inset-0 bg-zinc-500/75 transition-opacity dark:bg-zinc-900/50">
        </div>

        <div class="fixed inset-0 z-10 w-screen overflow-hidden">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                
                <div x-show="open"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    @click.away="open = false" 
                    class="relative transform flex flex-col overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full dark:bg-zinc-800 max-h-[90vh]" :class="$wire.modelo === 'Resumen' || $wire.modelo === 'Cintillo' ? 'sm:max-w-4xl' : ($wire.modelo === 'User' ? 'sm:max-w-2xl' : 'sm:max-w-xs')">
                    
                    <div class="bg-white px-4 pt-5 pb-2 sm:px-6 dark:bg-zinc-800 border-b border-zinc-700">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white" id="modal-title">
                            {{ $this->modelo == 'Resumen' ? 'Detalles del Resumen' : ($this->modelo == 'User' ? 'Detalles del Usuario' : ($this->modelo === 'Role' ? 'Detalles del Rol' : 'Detalles del Cintillo')) }}
                        </h2>
                    </div>

                    <div class="overflow-y-auto p-4 sm:p-6 bg-white dark:bg-zinc-800 custom-scrollbar">
                        <div class="mt-2">
                            <table class="w-full text-sm">
                                <thead class="bg-white dark:bg-zinc-800 z-10">
                                    <tr class="text-gray-500 dark:text-gray-400">
                                        @if ($modelo == 'Resumen')
                                        <th class="py-2 text-left">Origen</th>
                                        <th class="text-left">Destino</th>
                                        <th class="text-left">Buque</th>
                                        <th class="text-left">Nro. Embarque</th>
                                        <th class="text-left">Fecha</th>
                                        <th class="text-left">Nro. Viaje</th>
                                        <th class="text-left">Operación</th>
                                        <th class="text-left">Producto</th>

                                        @elseif ($modelo == 'User')
                                        <th class="py-2 text-left">Nombre</th>
                                        <th class="text-left">Email</th>
                                        <th class="text-left">Cedula</th>
                                        <th class="text-left">Terminal</th>

                                        @elseif ($modelo == 'Role')
                                        <th class="py-2 text-left">Nombre</th>
                                        <th class="text-left">Peso</th>

                                        @elseif ($modelo == 'Cintillo')
                                        <th></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-700">
                                    <tr>
                                        @if ($modelo == 'Resumen')
                                        <td>{{ $registro->terminalOrigen->nombre }}</td>
                                        <td>{{ $registro->terminalDestino->nombre }}</td>
                                        <td>{{ $registro->buque }}</td>
                                        <td>{{ $registro->nro_embarque }}</td>
                                        <td>{{ $registro->fecha_operacion }}</td>
                                        <td>{{ $registro->nro_viaje }}</td>
                                        <td>{{ $registro->operacion->nombre }}</td>
                                        <td>{{ $registro->producto->nombre }}</td>
                                        
                                        @elseif ($modelo == 'User')
                                        <td>{{ $registro->name }}</td>
                                        <td>{{ $registro->email }}</td>
                                        <td>{{ $registro->cedula }}</td>
                                        <td>{{ $registro->terminalOrigen->nombre }}</td>

                                        @elseif ($modelo == 'Role')
                                        <td>{{ $registro->name }}</td>
                                        <td>{{ $registro->peso }}</td>
                                        
                                        @elseif ($modelo == 'Cintillo')
                                        <td class="text-center">
                                            <img src="{{ asset('storage/' . $registro->nombre) }}" alt="Cintillo" class="mx-auto h-16">
                                        </td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-zinc-50 dark:bg-zinc-800/50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button @click="open = false" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
