<div>
    <x-card class="text-center pt-0">
        <x-primary-button class="my-4" wire:click="modalCrear">Añadir</x-primary-button>
        <x-text-input wire:model.live.debounce.300ms="nombre" placeholder="Buscar:" class="w-full mb-2" />
        <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700 text-left">
            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-zinc-700 text-left font-medium tracking-wider">Nombre</th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-zinc-700 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                @foreach($destinos as $destino)
                    <tr class="hover:bg-gray-100 dark:hover:bg-zinc-700">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $destino->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <x-edit-button class="text-amber-600 dark:text-amber-500 hover:text-amber-500 dark:hover:text-amber-400" wire:click="modalEditar({{ $destino->id }})"><i class="fas fa-pen"></i> Editar</x-edit-button>
                            <x-delete-button class="ml-2" wire:click="eliminar({{ $destino->id }})"><i class="fas fa-trash"></i> Eliminar</x-delete-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-card>

    <div x-data="{ open: @entangle('modalOpen') }" 
    x-show="open" 
    x-effect="if (open) { $nextTick(() => { $refs.focusInput.querySelector('input')?.focus() }) }"
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
                    class="relative transform flex flex-col overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full dark:bg-zinc-800 max-h-[90vh] sm:max-w-xl">
                    
                    <form @if ($accion == 'crear') wire:submit.prevent="crear" @elseif ($accion == 'editar') wire:submit.prevent="editar" @endif    >

                        <div class="bg-white px-4 pt-5 pb-2 sm:px-6 dark:bg-zinc-800 border-b border-zinc-700">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white" id="modal-title">
                                @if ($accion == 'crear') Crear Nuevo @else Editar @endif destino
                            </h2>
                        </div>

                        <div class="overflow-y-auto p-4 sm:p-6 bg-white dark:bg-zinc-800 custom-scrollbar">
                            <div class="mt-2" x-ref="focusInput">
                                <x-input-label for="destino" value="Nombre del Terminal de destino" />
                                <x-form-text-input wire:model="destino" name="destino" />
                            </div>
                        </div>

                        <div class="bg-zinc-50 dark:bg-zinc-800/50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button @click="open = false" type="button" class="mt-3 ml-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cerrar</button>

                            <x-primary-button>Crear</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
