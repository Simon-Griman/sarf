<form wire:submit.prevent="save" onsubmit="document.activeElement.blur()">
    <div class="space-y-12 sm:px-6" style="height: 79vh">
        <div class="border-b border-gray-400 dark:border-white/10 pb-12">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white inline-flex">Crear Cargamento</h2>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                <div class="sm:col-span-6 text-center">
                    <h2 class="">Agregar Cargamento</h2>
                </div>

                <div class="sm:col-span-2">
                    <label for="terminal_origen_id" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Terminal de Origen
                        @if($validaciones['terminal_origen'] ?? false)
                        <span class="text-red-500">*</span>
                        @endif
                    </label>
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
                    <label for="buque" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Buque
                        @if($validaciones['buque'] ?? false)
                        <span class="text-red-500">*</span>
                        @endif
                    </label>
                    <div class="mt-2">
                        <x-form-text-input id="buque" type="text" name="buque" autocomplete="buque" wire:model.blur="buque" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="nro_embarque" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Numero de Embarque<span class="text-red-500">*</span>
                    </label>
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

                <div class="sm:col-span-2">
                    <label for="cantidad_determinada" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Cantidad Determinada
                        @if($validaciones['cantidad_determinada'] ?? false)
                        <span class="text-red-500">*</span>
                        @endif
                    </label>
                    <div class="mt-2 grid grid-cols-1">
                        <x-form-select id="cantidad_determinada" name="cantidad_determinada" autocomplete="cantidad_determinada" wire:model.blur="cantidad_determinada" @blur="$wire.$refresh()">
                            <option value="">-- Seleccionar --</option>
                            <option value="Tanque de Tierra">Tanque de Tierra</option>
                            <option value="Cifras Buque">Cifras Buque</option>
                        </x-form-select>
                    </div>
                </div>

                <div class="sm:col-span-6 text-center">
                    <hr class="mb-4">
                    <h2 class="">Documentos</h2>
                </div>

                <div class="sm:col-span-2">
                    <label for="nominacion" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Nominación
                        @if($validaciones['nominacion'] ?? false)
                        <span class="text-red-500">*</span>
                        @endif
                    </label>
                    <div class="mt-2">
                        <x-form-text-input id="nominacion" type="file" class="file:py-0.5 file:cursor-pointer file:bg-transparent file:border-none file:text-blue-400 file:hover:underline file:active:text-blue-500" name="nominacion" autocomplete="family-name" wire:model.blur="nominacion" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="embarque" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Embarque
                        @if($validaciones['embarque'] ?? false)
                        <span class="text-red-500">*</span>
                        @endif
                    </label>
                    <div class="mt-2">
                        <x-form-text-input id="embarque" type="file" name="embarque" autocomplete="family-name" wire:model.blur="embarque" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="cantidad" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Certificado de Cantidad
                        @if($validaciones['cantidad'] ?? false)
                        <span class="text-red-500">*</span>
                        @endif
                    </label>
                    <div class="mt-2">
                        <x-form-text-input id="cantidad" type="file" name="cantidad" autocomplete="family-name" wire:model.blur="cantidad" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="calidad" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Certificado de Calidad
                        @if($validaciones['calidad'] ?? false)
                        <span class="text-red-500">*</span>
                        @endif
                    </label>
                    <div class="mt-2">
                        <x-form-text-input id="calidad" type="file" name="calidad" autocomplete="family-name" wire:model.blur="calidad" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="hoja_tiempo" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Hoja de Tiempo
                        @if($validaciones['hoja_tiempo'] ?? false)
                        <span class="text-red-500">*</span>
                        @endif
                    </label>
                    <div class="mt-2">
                        <x-form-text-input id="hoja_tiempo" type="file" name="hoja_tiempo" autocomplete="family-name" wire:model.blur="hoja_tiempo" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="acta" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Acta
                        @if($validaciones['acta'] ?? false)
                        <span class="text-red-500">*</span>
                        @endif
                    </label>
                    <div class="mt-2">
                        <x-form-text-input id="acta" type="file" name="acta" autocomplete="family-name" wire:model.blur="acta" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="ullage_inicial" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Ullage Inicial
                        @if($validaciones['ullage_inicial'] ?? false)
                        <span class="text-red-500">*</span>
                        @endif
                    </label>
                    <div class="mt-2">
                        <x-form-text-input id="ullage_inicial" type="file" name="ullage_inicial" autocomplete="family-name" wire:model.blur="ullage_inicial" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="ullage_final" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Ullage Final
                        @if($validaciones['ullage_final'] ?? false)
                        <span class="text-red-500">*</span>
                        @endif
                    </label>
                    <div class="mt-2">
                        <x-form-text-input id="ullage_final" type="file" name="ullage_final" autocomplete="family-name" wire:model.blur="ullage_final" @blur="$wire.$refresh()" />
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
