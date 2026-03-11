<div>
    <x-table>
        <x-slot name="thead">
            <tr>
                <th class="text-left pl-2">
                    <div x-data="{ open: false }" class="relative mt-2 flex justify-start">
                        <x-primary-button @click="open = !open">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                            Columnas
                        </x-primary-button>

                        <div x-show="open" @click.away="open = false" class="absolute left-0 mt-12 w-48 bg-gray-200 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-xl z-50 p-2">
                            @foreach($columns as $name => $visible)
                                <label wire:key="col-{{ $name }}" class="flex items-center px-4 py-2 hover:bg-gray-300 dark:hover:bg-gray-700 cursor-pointer rounded text-sm text-gray-800 dark:text-gray-300">
                                    <input type="checkbox" wire:click="$set('columns.{{ $name }}', {{ $visible ? 'false' : 'true' }})"
                                    @if($visible) checked @endif 
                                    class="rounded border-gray-600 bg-gray-300 dark:bg-gray-900 text-blue-600 mr-3">
                                    {{ ucfirst($name) }} 
                                </label>
                            @endforeach
                        </div>
                    </div>
                </th>

                @if($columns['destino'])<th></th>@endif
                @if($columns['buque'])<th></th>@endif
                @if($columns['nro_embarque'])<th></th>@endif
                @if($columns['nro_viaje'])<th></th>@endif
                @if($columns['operacion'])<th></th>@endif
                @if($columns['producto'])<th></th>@endif
                @if($columns['volumen'])<th></th>@endif

                @if($columns['fecha'])
                <th class="text-left pr-2">
                    <x-text-input type="date" wire:model.live.debounce.300ms="filters.fecha_inicio" class="mt-2"></x-text-input>
                </th>
                @endif

                <th></th>
            </tr>

            <tr>
                <th class="text-left px-2">
                    <select class="border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 focus:border-indigo-500 dark:focus:border-zinc-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-2 w-full custom-scrollbar" wire:model.live.debounce.300ms="filters.terminal_origen_id">
                        <option value="">Todo</option>

                        @foreach ($origenes as $ori)
                            <option value="{{ $ori->id }}">{{ $ori->nombre }}</option>
                        @endforeach
                    </select>
                </th>

                @if($columns['destino'])
                <th class="text-left pr-2">
                    <select class="border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 focus:border-indigo-500 dark:focus:border-zinc-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-2 w-full custom-scrollbar" wire:model.live.debounce.300ms="filters.terminal_destino_id">
                        <option value="">Todo</option>

                        @foreach ($destinos as $desti)
                            <option value="{{ $desti->id }}">{{ $desti->nombre }}</option>
                        @endforeach
                    </select>
                </th>
                @endif

                @if($columns['buque'])
                <th class="text-left pr-2"><x-text-input wire:model.live.debounce.300ms="filters.buque" class="mt-2"></x-text-input></th>
                @endif

                @if($columns['nro_embarque'])
                <th class="text-left pr-2"><x-text-input type="number" wire:model.live.debounce.300ms="filters.nro_embarque" class="mt-2"></x-text-input></th>
                @endif

                @if($columns['nro_viaje'])
                <th class="text-left pr-2">
                    <x-text-input type="number" wire:model.live.debounce.300ms="filters.nro_viaje" class="mt-2"></x-text-input>
                </th>
                @endif

                @if($columns['operacion'])
                <th class="text-left pr-2">
                    <select class="border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 focus:border-indigo-500 dark:focus:border-zinc-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-2 w-full custom-scrollbar" wire:model.live.debounce.300ms="filters.operacion_id">
                        <option value="">Todo</option>

                        @foreach ($operaciones as $opera)
                            <option value="{{ $opera->id }}">{{ $opera->nombre }}</option>
                        @endforeach
                    </select>
                </th>
                @endif

                @if($columns['producto'])
                <th class="text-left pr-2">
                    <select class="border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 focus:border-indigo-500 dark:focus:border-zinc-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-2 w-full custom-scrollbar" wire:model.live.debounce.300ms="filters.producto_id">
                        <option value="">Todo</option>

                        @foreach ($productos as $pro)
                            <option value="{{ $pro->id }}">{{ $pro->nombre }}</option>
                        @endforeach
                    </select>
                </th>
                @endif

                @if($columns['volumen'])
                <th class="text-left pr-2">
                    <x-text-input wire:model.live.debounce.300ms="filters.volumen" class="mt-2"></x-text-input>
                </th>
                @endif

                @if($columns['fecha'])
                <th class="text-left pr-2">
                    <x-text-input type="date" wire:model.live.debounce.300ms="filters.fecha_fin" class="mt-2"></x-text-input>
                </th>
                @endif

                <th class="pt-2">
                    @can('users.create')
                    <x-success-button wire:click="crearResumen"><i class="fas fa-user-plus pr-2"></i>Crear</x-success-button>
                    @endcan
                </th>
            </tr>

            <tr class="text-gray-900 dark:text-gray-100">
                <th class="px-4 py-3.5 text-sm font-medium text-left">Origen</th>

                @if($columns['destino'])
                <th class="px-4 py-3.5 text-sm font-medium text-left">Destino</th>
                @endif

                @if($columns['buque'])
                <th class="px-4 py-3.5 text-sm font-medium text-left">Buque</th>
                @endif

                @if($columns['nro_embarque'])
                <th class="px-4 py-3.5 text-sm font-medium text-left">Nro Embarque</th>
                @endif

                @if($columns['nro_viaje'])
                <th class="px-4 py-3.5 text-sm font-medium text-left">Nro Viaje</th>
                @endif

                @if($columns['operacion'])
                <th class="px-4 py-3.5 text-sm font-medium text-left">Operación</th>
                @endif

                @if($columns['producto'])
                <th class="px-4 py-3.5 text-sm font-medium text-left">Producto</th>
                @endif

                @if($columns['volumen'])
                <th class="px-4 py-3.5 text-sm font-medium text-left">Volumen</th>
                @endif

                @if($columns['fecha'])
                <th class="px-4 py-3.5 text-sm font-medium text-left">Fecha</th>
                @endif

                <th class="px-4 py-3.5 text-sm font-medium text-left">Acciones</th>
            </tr>
        </x-slot>

        @foreach ($resumenes as $resumen)
            <tr class="hover:bg-gray-100 dark:hover:bg-zinc-700/50 transition-colors duration-200 text-gray-700 dark:text-gray-200">
                
                <td class="px-4 py-4 text-sm whitespace-nowrap">
                    {{ $resumen->terminalOrigen->nombre ?? 'Sin terminal' }}
                </td>

                @if($columns['destino'])
                <td class="px-4 py-4 text-sm whitespace-nowrap">
                    {{ $resumen->terminalDestino->nombre ?? 'Sin terminal' }}
                </td>
                @endif

                @if($columns['buque'])
                <td class="px-4 py-4 text-sm whitespace-nowrap">
                    {{ $resumen->buque ?? 'Sin buque' }}
                </td>
                @endif

                @if($columns['nro_embarque'])
                <td class="px-4 py-4 text-sm whitespace-nowrap">
                    {{ $resumen->nro_embarque ?? 'Sin nro embarque' }}
                </td>
                @endif

                @if($columns['nro_viaje'])
                <td class="px-4 py-4 text-sm whitespace-nowrap">
                    {{ $resumen->nro_viaje ?? 'Sin nro viaje' }}
                </td>
                @endif

                @if($columns['operacion'])
                <td class="px-4 py-4 text-sm whitespace-nowrap">
                    {{ $resumen->operacion->nombre ?? 'Sin operación' }}
                </td>
                @endif

                @if($columns['producto'])
                <td class="px-4 py-4 text-sm whitespace-nowrap">
                    {{ $resumen->producto->nombre ?? 'Sin producto' }}
                </td>
                @endif

                @if($columns['volumen'])
                <td class="px-4 py-4 text-sm whitespace-nowrap">
                    {{ $resumen->volumen ?? 'Sin volumen' }}
                </td>
                @endif

                @if($columns['fecha'])
                <td class="px-4 py-4 text-sm whitespace-nowrap">
                    {{ $resumen->created_at?->format('d/m/Y') ?? 'Sin fecha' }}
                </td>
                @endif

                <td class="px-4 py-4 text-sm whitespace-nowrap">
                    @can('users.edit')
                    <x-edit-button onclick="window.location.href='{{ route('resumen.edit', $resumen->id) }}'"><i class="fas fa-pen-to-square"></i> Editar</x-edit-button>
                    @endcan

                    @can('users.destroy')
                    <x-delete-button wire:click="modalBorrar({{ $resumen->id }})"><i class="fas fa-trash"></i> Borrar</x-delete-button>
                    @endcan
                </td>
            </tr>
        @endforeach

        <x-slot name="tfoot">
            <tr>
                <td colspan="{{ (count(array_filter($columns))) }}" class="p-2">{{ $resumenes->links() }}</td>
                <td colspan="2" class="p-2">
                    @if ($resumenes->count() >= 10)
                        <span>Registros: </span>
                        <select class="border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 focus:border-indigo-500 dark:focus:border-zinc-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-2" wire:model.live.debounce.300ms="paginate">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    @endif
                </td>
            </tr>
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
            class="fixed inset-0 bg-gray-500/75 transition-opacity dark:bg-gray-900/50">
        </div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                
                <div x-show="open"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    @click.away="open = false" 
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg dark:bg-gray-800">
                    
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 dark:bg-gray-800">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-base font-semibold text-gray-900 dark:text-white" id="modal-title">Borrar Registro</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        ¿Estás seguro que deseas borrar el embarque: <strong>{{ $nro_embarque }}</strong>?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 dark:bg-gray-700/25">
                        <button type="button" wire:click="borrar" wire:loading.attr="disabled"  class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-500 sm:ml-3 sm:w-auto">
                            <span wire:loading.remove>Borrar</span>
                            <span wire:loading>Eliminando...</span>
                        </button>
                        <button type="button" @click="open = false" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 sm:mt-0 sm:w-auto">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
