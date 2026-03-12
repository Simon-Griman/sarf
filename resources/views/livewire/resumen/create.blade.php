<form wire:submit.prevent="save" onsubmit="document.activeElement.blur()">
    <div class="space-y-12 sm:px-6" style="height: 79vh">
        <div class="border-b border-gray-400 dark:border-white/10 pb-12">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white inline-flex">Crear Resumen de {{ $tipo_operacion }}</h2>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                <div class="sm:col-span-2">
                    <label for="terminal_origen_id" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Terminal de Origen<span class="text-red-500">*</span></label>
                    <div class="mt-2 grid grid-cols-1">
                        <x-form-select id="terminal_origen_id" name="terminal_origen_id" autocomplete="terminal_origen_id" wire:model.blur="terminal_origen_id" @blur="$wire.$refresh()">
                            <option value="">-- Seleccionar --</option>
                            @foreach ($origenes as $origen)
                                <option value="{{ $origen->id }}">{{ $origen->nombre }}</option>
                            @endforeach
                        </x-form-select>
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="terminal_destino_id" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Terminal de Destino<span class="text-red-500">*</span></label>
                    <div class="mt-2 grid grid-cols-1">
                        <x-form-select id="terminal_destino_id" name="terminal_destino_id" autocomplete="terminal_destino_id" wire:model.blur="terminal_destino_id" @blur="$wire.$refresh()">
                            <option value="">-- Seleccionar --</option>
                            @foreach ($destinos as $destino)
                                <option value="{{ $destino->id }}">{{ $destino->nombre }}</option>
                            @endforeach
                        </x-form-select>
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="buque" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Buque<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="buque" type="text" name="buque" autocomplete="buque" wire:model.blur="buque" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="nro_embarque" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Numero de Embarque<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="nro_embarque" type="number" name="nro_embarque" autocomplete="family-name" wire:model.blur="nro_embarque" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="nro_viaje" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Numero de Viaje<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="nro_viaje" type="number" name="nro_viaje" autocomplete="family-name" wire:model.blur="nro_viaje" @blur="$wire.$refresh()" />
                    </div>
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

                <div class="sm:col-span-2">
                    <label for="volumen" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Volumen<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="volumen" type="number" name="volumen" autocomplete="family-name" wire:model.blur="volumen" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="cantidad_determinada" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Cantidad Determinada<span class="text-red-500">*</span></label>
                    <div class="mt-2 grid grid-cols-1">
                        <x-form-select id="cantidad_determinada" name="cantidad_determinada" autocomplete="cantidad_determinada" wire:model.blur="cantidad_determinada" @blur="$wire.$refresh()">
                            <option value="">-- Seleccionar --</option>
                            <option value="Tanque de Tierra">Tanque de Tierra</option>
                            <option value="Cifras Buque">Cifras Buque</option>
                        </x-form-select>
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="documento" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Documento<span class="text-red-500">*</span></label>
                    <div class="mt-2 grid grid-cols-1">
                        <x-form-select id="documento" name="documento" autocomplete="documento" wire:model.blur="documento" @blur="$wire.$refresh()">
                            <option value="">-- Seleccionar --</option>
                            <option value="Borrador">Borrador</option>
                            <option value="Definitivo">Definitivo</option>
                        </x-form-select>
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="TOV" class="block text-sm/6 font-medium text-gray-800 dark:text-white">TOV<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="TOV" type="number" name="TOV" autocomplete="family-name" wire:model.blur="TOV" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="GOV" class="block text-sm/6 font-medium text-gray-800 dark:text-white">GOV<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="GOV" type="number" name="GOV" autocomplete="family-name" wire:model.blur="GOV" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="GSV" class="block text-sm/6 font-medium text-gray-800 dark:text-white">GSV<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="GSV" type="number" name="GSV" autocomplete="family-name" wire:model.blur="GSV" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="NSV" class="block text-sm/6 font-medium text-gray-800 dark:text-white">NSV<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="NSV" type="number" name="NSV" autocomplete="family-name" wire:model.blur="NSV" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="TCV" class="block text-sm/6 font-medium text-gray-800 dark:text-white">TCV<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="TCV" type="number" name="TCV" autocomplete="family-name" wire:model.blur="TCV" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="sediment_water" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Sediment Water<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="sediment_water" type="number" name="sediment_water" autocomplete="family-name" wire:model.blur="sediment_water" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="free_water" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Free Water<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="free_water" type="number" name="free_water" autocomplete="family-name" wire:model.blur="free_water" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="tabla_VCF" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Tabla VCF<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="tabla_VCF" type="number" name="tabla_VCF" autocomplete="family-name" wire:model.blur="tabla_VCF" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="temp" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Temp<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="temp" type="number" name="temp" autocomplete="family-name" wire:model.blur="temp" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="API" class="block text-sm/6 font-medium text-gray-800 dark:text-white">API<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="API" type="number" name="API" autocomplete="family-name" wire:model.blur="API" @blur="$wire.$refresh()" />
                    </div>
                </div>

                @if ($tipo_operacion === 'carga' || $tipo_operacion === 'importacion')

                <div class="sm:col-span-2">
                    <label for="OBQ" class="block text-sm/6 font-medium text-gray-800 dark:text-white">OBQ<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="OBQ" type="number" name="OBQ" autocomplete="family-name" wire:model.blur="OBQ" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="OBQ_agua" class="block text-sm/6 font-medium text-gray-800 dark:text-white">OBQ Agua<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="OBQ_agua" type="number" name="OBQ_agua" autocomplete="family-name" wire:model.blur="OBQ_agua" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="TCV_carga" class="block text-sm/6 font-medium text-gray-800 dark:text-white">TCV: Despues de la carga<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="TCV_carga" type="number" name="TCV_carga" autocomplete="family-name" wire:model.blur="TCV_carga" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="GSV_carga" class="block text-sm/6 font-medium text-gray-800 dark:text-white">GSV: Despues de la carga<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="GSV_carga" type="number" name="GSV_carga" autocomplete="family-name" wire:model.blur="GSV_carga" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="NSV_carga" class="block text-sm/6 font-medium text-gray-800 dark:text-white">NSV: Despues de la carga<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="NSV_carga" type="number" name="NSV_carga" autocomplete="family-name" wire:model.blur="NSV_carga" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="TRV" class="block text-sm/6 font-medium text-gray-800 dark:text-white">TRV<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="TRV" type="number" name="TRV" autocomplete="family-name" wire:model.blur="TRV" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="TRV_ajustado" class="block text-sm/6 font-medium text-gray-800 dark:text-white">TRV Ajustado<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="TRV_ajustado" type="number" name="TRV_ajustado" autocomplete="family-name" wire:model.blur="TRV_ajustado" @blur="$wire.$refresh()" />
                    </div>
                </div>

                @elseif ($tipo_operacion === 'descarga' || $tipo_operacion === 'exportacion')

                <div class="sm:col-span-2">
                    <label for="ROB" class="block text-sm/6 font-medium text-gray-800 dark:text-white">ROB<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="ROB" type="number" name="ROB" autocomplete="family-name" wire:model.blur="ROB" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="ROB_agua" class="block text-sm/6 font-medium text-gray-800 dark:text-white">ROB Agua<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="ROB_agua" type="number" name="ROB_agua" autocomplete="family-name" wire:model.blur="ROB_agua" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="TCV_descarga" class="block text-sm/6 font-medium text-gray-800 dark:text-white">TCV: Antes de la descarga<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="TCV_descarga" type="number" name="TCV_descarga" autocomplete="family-name" wire:model.blur="TCV_descarga" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="GSV_descarga" class="block text-sm/6 font-medium text-gray-800 dark:text-white">GSV: Antes de la descarga<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="GSV_descarga" type="number" name="GSV_descarga" autocomplete="family-name" wire:model.blur="GSV_descarga" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="NSV_descarga" class="block text-sm/6 font-medium text-gray-800 dark:text-white">NSV: Antes de la descarga<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="NSV_descarga" type="number" name="NSV_descarga" autocomplete="family-name" wire:model.blur="NSV_descarga" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="TDV" class="block text-sm/6 font-medium text-gray-800 dark:text-white">TDV<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="TDV" type="number" name="TDV" autocomplete="family-name" wire:model.blur="TDV" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="TDV_ajustado" class="block text-sm/6 font-medium text-gray-800 dark:text-white">TDV Ajustado<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="TDV_ajustado" type="number" name="TDV_ajustado" autocomplete="family-name" wire:model.blur="TDV_ajustado" @blur="$wire.$refresh()" />
                    </div>
                </div>

                @endif

                <div class="sm:col-span-2">
                    <label for="VEF" class="block text-sm/6 font-medium text-gray-800 dark:text-white">VEF<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="VEF" type="number" name="VEF" autocomplete="family-name" wire:model.blur="VEF" @blur="$wire.$refresh()" />
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6 px-6 pb-4">
            <x-cancel-button href="{{ route('resumen.index') }}" />
            <x-primary-button>Guardar</x-primary-button>
        </div>
    </div>
</form>
