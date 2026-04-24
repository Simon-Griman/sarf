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
    {{$registro->nro_embarque}}
    <!-- TODO: Agregar modal para mostrar detalles del registro creado -->
</div>
