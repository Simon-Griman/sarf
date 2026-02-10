<x-table>
    <x-slot name="thead">
        <tr>
            @if($columns['usuario'])
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
            @endif

            @if($columns['cedula'])<th></th>@endif
            @if($columns['terminal'])<th></th>@endif
            @if($columns['rol'])<th></th>@endif

            @if($columns['fecha'])
            <th class="text-left pr-2">
                <x-text-input type="date" wire:model.live.debounce.300ms="filters.fecha_inicio" class="mt-2"></x-text-input>
            </th>
            @endif
        </tr>
        <tr>
            @if($columns['usuario'])
            <th class="text-left pl-2"><x-text-input wire:model.live.debounce.300ms="filters.name" class="mt-2"></x-text-input></th>
            @endif

            @if($columns['cedula'])
            <th class="text-left"><x-text-input wire:model.live.debounce.300ms="filters.cedula" class="mt-2"></x-text-input></th>
            @endif

            @if($columns['terminal'])
            <th class="text-left">
                <select class="border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 focus:border-indigo-500 dark:focus:border-zinc-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-2" wire:model.live.debounce.300ms="filters.nombre">
                    <option value="">Todo</option>

                    @foreach ($terminal as $item)
                    <option value="{{ $item->nombre }}">{{ $item->nombre }}</option>
                    @endforeach
                </select>
            </th>
            @endif

            @if($columns['rol'])
            <th class="text-left"><x-text-input wire:model.live.debounce.300ms="filters.rol" class="mt-2"></x-text-input></th>
            @endif

            @if($columns['fecha'])
            <th class="text-left pr-2">
                <x-text-input type="date" wire:model.live.debounce.300ms="filters.fecha_fin" class="mt-2"></x-text-input>
            </th>
            @endif
        </tr>
        <tr>
            @if($columns['usuario'])
            <th class="px-4 py-3.5 text-sm font-medium text-left text-gray-500 dark:text-gray-100">Usuario</th>
            @endif

            @if($columns['cedula'])
            <th class="px-4 py-3.5 text-sm font-medium text-left text-gray-500 dark:text-gray-100">Cedula</th>
            @endif

            @if($columns['terminal'])
            <th class="px-4 py-3.5 text-sm font-medium text-left text-gray-500 dark:text-white">Terminal</th>
            @endif

            @if($columns['rol'])
            <th class="px-4 py-3.5 text-sm font-medium text-left text-gray-500 dark:text-white">Rol</th>
            @endif

            @if($columns['fecha'])
            <th class="px-4 py-3.5 text-sm font-medium text-left text-gray-500 dark:text-white">Fecha</th>
            @endif
        </tr>
    </x-slot>

    @foreach($users as $user)
        <tr class="hover:bg-gray-100 dark:hover:bg-zinc-700/50 transition-colors duration-200">
            @if($columns['usuario'])
            <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                <div class="flex items-center gap-x-3">
                    {{--<img class="object-cover w-10 h-10 rounded-full" src="{{ $user->avatar_url }}" alt="">--}}
                    <div>
                        <h2 class="font-medium text-gray-800 dark:text-white ">{{ $user->name }}</h2>
                        <p class="text-xs font-normal text-gray-600 dark:text-gray-300">{{ $user->email }}</p>
                    </div>
                </div>
            </td>
            @endif

            @if($columns['cedula'])
            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-200 whitespace-nowrap">
                {{ $user->cedula }}
            </td>
            @endif

            @if($columns['terminal'])
            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-200 whitespace-nowrap">
                {{ $user->terminalOrigen->nombre ?? 'Sin terminal' }}
            </td>
            @endif

            @if($columns['rol'])
            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-200 whitespace-nowrap">
                Admin
            </td>
            @endif

            @if($columns['fecha'])
            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-200 whitespace-nowrap">
                {{ $user->created_at }}
            </td>
            @endif
        </tr>
    @endforeach

    <x-slot name="tfoot">
        <tr>
            <td colspan="{{ (count(array_filter($columns)))-1 }}" class="p-2">{{ $users->links() }}</td>
            <td class="p-2">
                @if ($users->count() >= 10)
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