<form wire:submit.prevent="update" onsubmit="document.activeElement.blur()">
    <div class="space-y-12 sm:px-6" style="height: 79vh">
        <div class="border-b border-gray-400 dark:border-white/10 pb-12">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white inline-flex">Editar Resumen de {{ $tipo_operacion }}</h2>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                <div class="sm:col-span-6 text-center">
                    <h2 class="">Resumen del Cargamento</h2>
                </div>

                <div class="sm:col-span-2">
                    <label for="nro_embarque" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Numero de Embarque<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="nro_embarque" type="number" name="nro_embarque" autocomplete="family-name" wire:model.blur="nro_embarque" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="fecha_operacion" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Fecha Final de Operación
                        @if($validaciones['fecha_operacion'] ?? false)
                        <span class="text-red-500">*</span>
                        @endif
                    </label>
                    <div class="mt-2">
                        <x-form-text-input id="fecha_operacion" type="date" name="fecha_operacion" autocomplete="family-name" wire:model.blur="fecha_operacion" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="operacion_id" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Tipo de Operación<span class="text-red-500">*</span></label>
                    <div class="mt-2 grid grid-cols-1">
                        <x-form-select id="operacion_id" name="operacion_id" autocomplete="operacion_id" wire:model.blur="operacion_id" @blur="$wire.$refresh()">
                            <option value="">-- Seleccionar --</option>
                            @foreach ($operaciones as $operacion)
                                <option value="{{ $operacion->id }}">{{ $operacion->nombre }}</option>
                            @endforeach
                        </x-form-select>
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="nro_ruta" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Numero de Ruta<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="nro_ruta" type="number" name="nro_ruta" autocomplete="family-name" wire:model.blur="nro_ruta" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="inspector" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Compañía Inspectora
                        @if($validaciones['inspector'] ?? false)
                        <span class="text-red-500">*</span>
                        @endif
                    </label>
                    <div class="mt-2 grid grid-cols-1">
                        <x-form-select id="inspector" name="inspector_id" autocomplete="inspector_id" wire:model.blur="inspector_id" @blur="$wire.$refresh()">
                            <option value="">-- Seleccionar --</option>
                            @foreach ($inspectores as $inspector)
                                <option value="{{ $inspector->id }}">{{ $inspector->nombre }}</option>
                            @endforeach
                        </x-form-select>
                    </div>
                </div>

                <div class="sm:col-span-6 text-center">
                    <hr class="mb-4">
                    <h2 class="">Documentos</h2>
                </div>

                <div class="sm:col-span-2">
                    <label for="nominacion" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Nominación</label>
                    <div class="mt-2">
                        <x-form-text-input id="nominacion" type="file" name="nominacion" autocomplete="family-name" wire:model.blur="nominacion" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="embarque" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Embarque</label>
                    <div class="mt-2">
                        <x-form-text-input id="embarque" type="file" name="embarque" autocomplete="family-name" wire:model.blur="embarque" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="cantidad" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Certificado de Cantidad</label>
                    <div class="mt-2">
                        <x-form-text-input id="cantidad" type="file" name="cantidad" autocomplete="family-name" wire:model.blur="cantidad" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="calidad" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Certificado de Calidad</label>
                    <div class="mt-2">
                        <x-form-text-input id="calidad" type="file" name="calidad" autocomplete="family-name" wire:model.blur="calidad" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="hoja_tiempo" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Hoja de Tiempo</label>
                    <div class="mt-2">
                        <x-form-text-input id="hoja_tiempo" type="file" name="hoja_tiempo" autocomplete="family-name" wire:model.blur="hoja_tiempo" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="acta" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Acta</label>
                    <div class="mt-2">
                        <x-form-text-input id="acta" type="file" name="acta" autocomplete="family-name" wire:model.blur="acta" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="ullage_inicial" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Ullage Inicial</label>
                    <div class="mt-2">
                        <x-form-text-input id="ullage_inicial" type="file" name="ullage_inicial" autocomplete="family-name" wire:model.blur="ullage_inicial" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="ullage_final" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Ullage Final</label>
                    <div class="mt-2">
                        <x-form-text-input id="ullage_final" type="file" name="ullage_final" autocomplete="family-name" wire:model.blur="ullage_final" @blur="$wire.$refresh()" />
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6 px-6 pb-4">
            <x-cancel-button href="{{ route('cargamento.index') }}" @keydown.window="if ($event.key.toLowerCase() === 'escape' && !$event.target.closest('input, textarea, select')) { window.location.href = '{{ route('cargamento.index') }}' }"/>
            <x-primary-button @keydown.window.ctrl.enter.prevent="document.activeElement.blur(); $nextTick(() => $wire.update())">Guardar</x-primary-button>
        </div>
    </div>
</form>