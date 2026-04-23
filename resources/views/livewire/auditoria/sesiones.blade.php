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

        <div class="fixed inset-0 z-10 w-screen overflow-hidden">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                
                <div x-show="open"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    @click.away="open = false" 
                    class="relative transform flex flex-col overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl dark:bg-zinc-800 max-h-[90vh]">
                    
                    <div class="bg-white px-4 pt-5 pb-2 sm:px-6 dark:bg-zinc-800 border-b border-zinc-700">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white" id="modal-title">
                            Sesiones de {{ $name }}
                        </h2>
                    </div>

                    <div class="overflow-y-auto p-4 sm:p-6 bg-white dark:bg-zinc-800 custom-scrollbar">
                        <div class="mt-2">
                            <table class="w-full text-sm">
                                <thead class="bg-white dark:bg-zinc-800 z-10">
                                    <tr class="text-gray-500 dark:text-gray-400">
                                        <th class="py-2 text-left">IP</th>
                                        <th class="text-left">Sistema</th>
                                        <th class="text-left">Navegador</th>
                                        <th class="text-left">Fecha y Hora</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-700">
                                @foreach ($log_usuario as $item)
                                    <tr class="hover:bg-zinc-100 dark:hover:bg-zinc-700 transition-colors">
                                        <td class="py-2">{{ $item->ip_address }}</td>
                                        <td>{{ $item->sistema }}</td>
                                        <td>{{ $item->navegador }}</td>
                                        <td class="whitespace-nowrap">{{ $item->login_at }}</td>
                                    </tr>
                                @endforeach
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
