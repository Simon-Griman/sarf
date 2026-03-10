<div>
    <x-table>
        <x-slot name="thead">
            <tr class="text-gray-900 dark:text-gray-100">
                @if ($columns['origen'])
                <th class="px-4 py-3.5 text-sm font-medium text-left">Origen</th>
                @endif

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
                
                @if($columns['origen'])
                <td class="px-4 py-4 text-sm whitespace-nowrap">
                    {{ $resumen->terminalOrigen->nombre ?? 'Sin terminal' }}
                </td>
                @endif

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
                    <x-edit-button onclick="window.location.href='{{ route('users.edit', $resumen->id) }}'"><i class="fas fa-pen-to-square"></i> Editar</x-edit-button>
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
                <td class="p-2">
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
</div>
