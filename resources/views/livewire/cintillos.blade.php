<div>
    @can('cintillos.create')
    <div class="text-center">
        <x-primary-button wire:click="modalUp()">Nuevo Cintillo</x-primary-button>
    </div>  
    @endcan

    <x-card>
        <table class="table table-responsive table-hover">
            <thead>
                <tr class="text-left text-gray-700 dark:text-gray-200">
                    <th class="pb-4">Cintillo</th>
                    @if (auth()->user()->can('cintillos.edit') || auth()->user()->can('cintillos.delete'))
                    <th class="text-center pb-4">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            @foreach($cintillos as $item)
                <tr>
                    <td class="py-1"><img src="{{ url('storage/' . $item->nombre) }}" alt="" class="cintillo" style="width:100%"></td>
                    
                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                        @can('cintillos.activar')
                        <x-edit-button wire:click="modalActivar({{ $item->id }})"><i class="fas fa-check-circle"></i> Activar</x-edit-button>
                        @endcan

                        @can('cintillos.destroy')
                        <x-delete-button wire:click="confirBorrar({{ $item->id }})"><i class="fas fa-trash"></i> Borrar</x-delete-button>
                        @endcan
                    </td>
                    
                </tr>
            @endforeach
            </tbody>
        </table>

        <div x-data="{ open: @entangle('modalOpen') }" 
            x-show="open" 
            class="relative z-10" 
            aria-labelledby="modal-title" 
            role="dialog" 
            aria-modal="true"
            style="display: none;"> <div x-show="open" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                class="fixed inset-0 bg-gray-500/75 transition-opacity dark:bg-zinc-900/75"></div>

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
                                    <h3 class="text-base font-semibold text-gray-900 dark:text-white" id="modal-title">{{ $titulo }}</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $mensaje }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4">
                            @if ($accion == 'up')
                                <input type="file" wire:model="cintillo">
                                @error ('cintillo') <span class="block text-red-600 p-2">{{ $message }}</span> @enderror

                            @elseif ($accion == 'activar')
                                <label for="modo">Selecciona el modo de visualización</label>
                                <x-form-select name="modo" id="modo" wire:model="modo">
                                    <option value="">-- Seleccionar --</option>
                                    <option value="claro">Claro</option>
                                    <option value="oscuro">Oscuro</option>
                                </x-form-select>
                            @endif
                        </div>

                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 dark:bg-zinc-700/25">
                            <button type="button" wire:click="{{ $accion }}" wire:loading.attr="disabled"  class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-500 sm:ml-3 sm:w-auto">
                                <span wire:loading.remove>{{ $boton }}</span>
                                <span wire:loading>Procesando...</span>
                            </button>
                            <button type="button" @click="open = false" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 sm:mt-0 sm:w-auto">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-card>
</div>