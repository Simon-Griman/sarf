<form wire:submit.prevent="save" onsubmit="document.activeElement.blur()">
    <div class="space-y-12 sm:px-6" style="height: 79vh">
        <div class="border-b border-gray-400 dark:border-white/10 pb-12">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white inline-flex">Información del Usuario</h2>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="nombre" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Nombre<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="nombre" type="text" name="nombre" autocomplete="given-name" wire:model.blur="nombre" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="cedula" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Cedula<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="cedula" type="number" name="cedula" autocomplete="family-name" wire:model.blur="cedula" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="correo" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Correo Electrónico<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-form-text-input id="correo" type="email" name="correo" autocomplete="correo" wire:model.blur="correo" @blur="$wire.$refresh()" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="terminal_user" class="block text-sm/6 font-medium text-gray-800 dark:text-white">Terminal de Origen<span class="text-red-500">*</span></label>
                    <div class="mt-2 grid grid-cols-1">
                        <x-form-select id="terminal_user" name="terminal_user" autocomplete="terminal_user" wire:model.blur="terminal_user" @blur="$wire.$refresh()">
                            <option value="">-- Seleccionar --</option>
                            @foreach ($terminales as $terminal)
                                <option value="{{ $terminal->id }}">{{ $terminal->nombre }}</option>
                            @endforeach
                        </x-form-select>
                    </div>
                </div>

                <div class="sm:col-span-3" x-data="{ open: false }">
                    <label class="block text-sm/6 font-medium text-gray-800 dark:text-white">Roles</label>
                    
                    <div class="relative mt-2 @click.away="open = false">
                        <button 
                            @click="open = !open" 
                            type="button" 
                            class="w-full flex items-center justify-between bg-white/5 dark:bg-zinc-800 border border-zinc-500 rounded-md px-4 py-1.5 text-left text-gray-300 hover:border-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all"
                        >
                            <span class="truncate text-gray-800 dark:text-white">
                                @if(count($selectedRoles) > 0)
                                    {{ implode(', ', $selectedRoles) }}
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
                            <div class="p-2 space-y-1 max-h-60 overflow-y-auto bg-zinc-50 dark:bg-zinc-800/5 custom-scrollbar">
                                @foreach($roles as $role)
                                    @if($role->peso <= auth()->user()->roles->max('peso'))
                                    <label class="flex items-center px-3 py-2 hover:bg-zinc-200 dark:hover:bg-zinc-800 rounded-md cursor-pointer group transition-colors">
                                        <input 
                                            type="checkbox" 
                                            value="{{ $role->name }}" 
                                            wire:model.live="selectedRoles" 
                                            id="role_{{ $role->id }}"
                                            class="w-4 h-4 rounded border-zinc-600 bg-zinc-200 dark:bg-zinc-800 text-blue-600 focus:ring-blue-500 focus:ring-offset-blue-600"
                                        >
                                        <span class="ml-3 text-sm text-gray-800 dark:text-gray-300 group-hover:text-gray-800 dark:group-hover:text-white">
                                            {{ $role->name }}
                                        </span>
                                    </label>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6 px-6 pb-4">
            <x-cancel-button href="{{ route('users.index') }}" />
            <x-primary-button>Guardar</x-primary-button>
        </div>
    </div>
</form>
