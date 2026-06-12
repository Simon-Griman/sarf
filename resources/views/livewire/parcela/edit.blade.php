<form wire:submit.prevent="save" onsubmit="document.activeElement.blur()">
    <div class="space-y-12 sm:px-6" style="height: 79vh">
        <div class="border-b border-gray-400 dark:border-white/10 pb-12">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white inline-flex">Editar Parcela</h2>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                <div class="sm:col-span-6 text-center">
                    <h2 class="">Resumen de la Parcela</h2>
                </div>

                <div class="sm:col-span-2">
                    <label for="producto_id" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Producto<span class="text-red-500">*</span></label>
                    <div class="mt-2 grid grid-cols-1">
                        <x-form-select id="producto_id" name="producto_id" autocomplete="producto_id" wire:model.blur="producto_id" @blur="$wire.$refresh()">
                            <option value="">-- Seleccionar --</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </x-form-select>
                    </div>
                </div>

                <div class="sm:col-span-2" x-data="{ open: false }">
                    <label class="block text-sm/6 font-medium text-gray-800 dark:text-white">Terminales de Destino<span class="text-red-500">*</span></label>
                    
                    <div class="relative mt-2" @click.away="open = false">
                        <button 
                            @click="open = !open" 
                            type="button" 
                            class="w-full flex items-center justify-between bg-white/5 dark:bg-zinc-700 border border-zinc-500 rounded-md px-4 py-1.5 text-left text-gray-300 hover:border-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all"
                        >
                            <span class="truncate text-gray-800 dark:text-white">
                                @if(count($terminales_destinos_ids) > 0)
                                    {{ implode(', ', $terminales_destinos_ids) }}
                                @else
                                      -- Seleccionar --
                                @endif
                            </span>
                            
                            <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div 
                            x-show="open"
                            wire:ignore 
                            x-transition
                            class="absolute z-50 w-full bg-[#252525] border border-zinc-700 rounded-lg shadow-2xl overflow-hidden"
                            style="display: none;"
                        >
                            <div class="p-2 space-y-1 max-h-60 overflow-y-auto bg-zinc-50 dark:bg-zinc-700 custom-scrollbar">
                                @foreach($destinos as $destino)
                                    <label class="flex items-center px-3 py-2 hover:bg-zinc-200 dark:hover:bg-zinc-800 rounded-md cursor-pointer group transition-colors">
                                        <input 
                                            type="checkbox" 
                                            value="{{ $destino->id }}" 
                                            wire:model.live="terminales_destinos_ids" 
                                            id="destino_{{ $destino->id }}"
                                            class="w-4 h-4 rounded border-zinc-600 bg-zinc-200 dark:bg-zinc-800 text-blue-600 focus:ring-blue-500 focus:ring-offset-blue-600"
                                        >
                                        <span class="ml-3 text-sm text-gray-800 dark:text-gray-300 group-hover:text-gray-800 dark:group-hover:text-white">
                                            {{ $destino->id }}. {{ $destino->nombre }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @error('terminales_destinos_ids') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="volumen" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Volumen<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="volumen" type="number" name="volumen" autocomplete="family-name" wire:model.blur="volumen" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-6 text-center">
                    <hr class="mb-4">
                    <h2 class="">Datos Tierra</h2>
                </div>

                <div class="sm:col-span-2">
                    <label for="TOV" class="block text-sm/6 font-medium text-gray-800 dark:text-white">TOV<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="TOV" type="number" step="0.01" name="TOV" autocomplete="family-name" wire:model.blur="TOV" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="GOV" class="block text-sm/6 font-medium text-gray-800 dark:text-white">GOV<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="GOV" type="number" step="0.01" name="GOV" autocomplete="family-name" wire:model.blur="GOV" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="GSV" class="block text-sm/6 font-medium text-gray-800 dark:text-white">GSV<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="GSV" type="number" step="0.01" name="GSV" autocomplete="family-name" wire:model.blur="GSV" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="NSV" class="block text-sm/6 font-medium text-gray-800 dark:text-white">NSV<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="NSV" type="number" step="0.01" name="NSV" autocomplete="family-name" wire:model.blur="NSV" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="TCV" class="block text-sm/6 font-medium text-gray-800 dark:text-white">TCV<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="TCV" type="number" step="0.01" name="TCV" autocomplete="family-name" wire:model.blur="TCV" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="sediment_water" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Agua y Sedimento<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="sediment_water" type="number" step="0.01" name="sediment_water" autocomplete="family-name" placeholder="Bbls" wire:model.blur="sediment_water" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="free_water" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Agua Libre<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="free_water" type="number" step="0.01" name="free_water" autocomplete="family-name" wire:model.blur="free_water" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="agua_sedimento" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Agua y Sedimento<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="agua_sedimento" type="number" step="0.01" name="agua_sedimento" autocomplete="family-name" placeholder="%" wire:model.blur="agua_sedimento" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="temp" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Temp<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="temp" type="number" step="0.1" name="temp" autocomplete="family-name" wire:model.blur="temp" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="API" class="block text-sm/6 font-medium text-gray-800 dark:text-white">API<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="API" type="number" step="0.1" name="API" autocomplete="family-name" wire:model.blur="API" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="azufre" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Azufre<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="azufre" type="number" step="0.001" name="azufre" autocomplete="family-name" wire:model.blur="azufre" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-6 text-center">
                    <hr class="mb-4">
                    <h2 class="">Datos Buque</h2>
                </div>

                @if ($tipo_operacion === 'carga' || $tipo_operacion === 'exportacion')

                <div class="sm:col-span-2">
                    <label for="OBQ" class="block text-sm/6 font-medium text-gray-800 dark:text-white">OBQ<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="OBQ" type="number" step="0.01"  name="OBQ" autocomplete="family-name" wire:model.blur="OBQ" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="OBQ_agua" class="block text-sm/6 font-medium text-gray-800 dark:text-white">OBQ Agua<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="OBQ_agua" type="number" step="0.01" name="OBQ_agua" autocomplete="family-name" wire:model.blur="OBQ_agua" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="TCV_carga" class="block text-sm/6 font-medium text-gray-800 dark:text-white">TCV: Despues de la carga<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="TCV_carga" type="number" step="0.01" name="TCV_carga" autocomplete="family-name" wire:model.blur="TCV_carga" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="GSV_carga" class="block text-sm/6 font-medium text-gray-800 dark:text-white">GSV: Despues de la carga<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="GSV_carga" type="number" step="0.01" name="GSV_carga" autocomplete="family-name" wire:model.blur="GSV_carga" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="NSV_carga" class="block text-sm/6 font-medium text-gray-800 dark:text-white">NSV: Despues de la carga<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="NSV_carga" type="number" step="0.01" name="NSV_carga" autocomplete="family-name" wire:model.blur="NSV_carga" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="TRV" class="block text-sm/6 font-medium text-gray-800 dark:text-white">TRV<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="TRV" type="number" step="0.01" name="TRV" autocomplete="family-name" wire:model.blur="TRV" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="TRV_ajustado" class="block text-sm/6 font-medium text-gray-800 dark:text-white">TRV Ajustado<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="TRV_ajustado" type="number" step="0.01" name="TRV_ajustado" autocomplete="family-name" wire:model.blur="TRV_ajustado" @blur="$wire.$refresh()" />
                    </div>
                </div>

                @elseif ($tipo_operacion === 'descarga' || $tipo_operacion === 'importacion')

                <div class="sm:col-span-2">
                    <label for="ROB" class="block text-sm/6 font-medium text-gray-800 dark:text-white">ROB<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="ROB" type="number" step="0.01" name="ROB" autocomplete="family-name" wire:model.blur="ROB" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="ROB_agua" class="block text-sm/6 font-medium text-gray-800 dark:text-white">ROB Agua<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="ROB_agua" type="number" step="0.01" name="ROB_agua" autocomplete="family-name" wire:model.blur="ROB_agua" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="TCV_descarga" class="block text-sm/6 font-medium text-gray-800 dark:text-white">TCV: Antes de la descarga<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="TCV_descarga" type="number" step="0.01" name="TCV_descarga" autocomplete="family-name" wire:model.blur="TCV_descarga" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="GSV_descarga" class="block text-sm/6 font-medium text-gray-800 dark:text-white">GSV: Antes de la descarga<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="GSV_descarga" type="number" step="0.01" name="GSV_descarga" autocomplete="family-name" wire:model.blur="GSV_descarga" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="NSV_descarga" class="block text-sm/6 font-medium text-gray-800 dark:text-white">NSV: Antes de la descarga<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="NSV_descarga" type="number" step="0.01" name="NSV_descarga" autocomplete="family-name" wire:model.blur="NSV_descarga" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="TDV" class="block text-sm/6 font-medium text-gray-800 dark:text-white">TDV<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="TDV" type="number" step="0.01" name="TDV" autocomplete="family-name" wire:model.blur="TDV" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="TDV_ajustado" class="block text-sm/6 font-medium text-gray-800 dark:text-white">TDV Ajustado<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="TDV_ajustado" type="number" step="0.01" name="TDV_ajustado" autocomplete="family-name" wire:model.blur="TDV_ajustado" @blur="$wire.$refresh()" />
                    </div>
                </div>

                @endif

                <div class="sm:col-span-2">
                    <label for="VEF" class="block text-sm/6 font-medium text-gray-800 dark:text-white">VEF<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="VEF" type="number" step="0.0001" name="VEF" autocomplete="family-name" wire:model.blur="VEF" @blur="$wire.$refresh()" />
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="mt-6">
                    <h3 class="text-mediun">Errores por Corregir:</h3>
                    <x-input-error :messages="$errors->all()" />
                </div>
            @endif
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6 px-6 pb-4">
            <x-cancel-button href="{{ route('cargamento.index') }}" />
            <x-primary-button>Guardar</x-primary-button>
        </div>
    </div>
</form>
