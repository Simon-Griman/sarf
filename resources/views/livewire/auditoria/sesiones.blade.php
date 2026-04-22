<div>
    <x-table>
        <x-slot name="thead">
            <tr>
                <th></th>
                <th class="p-2" colspan="4"><x-text-input placeholder="Buscar Usuario:" wire:model.live.debounce.300ms="buscar"></x-text-input></th>
                <th></th>
            </tr>
            <tr>
                <th class="text-left px-2 py-4">Usuario</th>
                <th class="text-left pr-2">IP</th>
                <th class="text-left pr-2">Sistema</th>
                <th class="text-left pr-2">Navegador</th>
                <th class="text-left pr-2">Ultima Sesión</th>
                <th class="text-left pr-2">Acciones</th>
            </tr>
        </x-slot>

        
            @foreach ($sesiones as $sesion)
                <tr class="hover:bg-gray-100 dark:hover:bg-zinc-700/50 transition-colors duration-200 text-gray-700 dark:text-gray-200">
                    <td class="p-2">{{ $sesion->user->name }}</td>
                    <td>{{ $sesion->ip_address }}</td>
                    <td>{{ $sesion->sistema }}</td>
                    <td>{{ $sesion->navegador }}</td>
                    <td>{{ Carbon\Carbon::create($sesion->login_at)->diffForHumans() }}</td>
                    <td>
                        <x-edit-button wire:click="ver('{{ $sesion->user->id }}')"><i class="fas fa-list"></i> Ver Detalles</x-edit-button>
                    </td>
                </tr>
            @endforeach
        
        <x-slot name="tfoot">
            <td colspan="6" class="p-2">{{ $sesiones->links() }}</td>
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

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                
                <div x-show="open"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    @click.away="open = false" 
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg dark:bg-zinc-800">
                    
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 dark:bg-zinc-800">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white" id="modal-title">Sesiones de {{ $name }}</h3>
                                <div class="mt-2">
                                    <table>
                                        <thead>
                                            <th class="py-2">IP</th>
                                            <th>Sistema</th>
                                            <th class="pr-4">Navegador</th>
                                            <th>Fecha y Hora</th>
                                        </thead>
                                        <tbody>
                                        @foreach ($log_usuario as $item)
                                            <tr class="hover:bg-zinc-700">
                                                <td class="py-2">{{ $item->login_at }}</td>
                                                <td>{{ $item->sistema }}</td>
                                                <td>{{ $item->navegador }}</td>
                                                <td>{{ $item->login_at }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 dark:bg-gray-700/25">
                        <button type="button" @click="open = false" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 sm:mt-0 sm:w-auto hover:bg-gray-300 active:bg-white">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
