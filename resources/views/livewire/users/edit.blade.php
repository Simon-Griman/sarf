<form wire:submit.prevent="update" onsubmit="document.activeElement.blur()">
    <div class="space-y-12 sm:px-6" style="height: 79vh">
        <div class="border-b border-white/10 pb-12">
            <h2 class=" text-xl font-semibold text-white inline-flex">Información del Usuario</h2>

            <div class="inline-flex gap-x-2 float-right">
                <x-warning-button wire:click="resetPassword"><i class="fa-solid fa-key pr-2"></i>Resetear Contraseña</x-warning-button>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="nombre" class="block text-sm/6 font-medium text-white">Nombre<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <input id="nombre" type="text" name="nombre" autocomplete="given-name" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6 @error('nombre') border-red-500 @enderror" wire:model.blur="nombre" @blur="$wire.$refresh()" />
                    </div>
                    @error('nombre') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="sm:col-span-3">
                    <label for="cedula" class="block text-sm/6 font-medium text-white">Cedula<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <input id="cedula" type="number" name="cedula" autocomplete="family-name" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6 @error('cedula') border-red-500 @enderror" wire:model.blur="cedula" @blur="$wire.$refresh()" />
                    </div>
                    @error('cedula') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="sm:col-span-4">
                    <label for="email" class="block text-sm/6 font-medium text-white">Correo Electrónico<span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <input id="email" type="email" name="email" autocomplete="email" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6 @error('correo') border-red-500 @enderror" wire:model.blur="correo" @blur="$wire.$refresh()" />
                    </div>
                    @error('correo') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="sm:col-span-3">
                    <label for="terminal_user" class="block text-sm/6 font-medium text-white">Terminal de Origen<span class="text-red-500">*</span></label>
                    <div class="mt-2 grid grid-cols-1">
                        <select id="terminal_user" name="terminal_user" autocomplete="terminal_user" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white/5 py-1.5 pr-8 pl-3 text-base text-white outline-1 -outline-offset-1 outline-white/10 *:bg-gray-800 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6 @error('terminal_user') border-red-500 @enderror" wire:model.blur="terminal_user" @blur="$wire.$refresh()">
                            @foreach ($terminales as $terminal)
                                <option value="{{ $terminal->id }}">{{ $terminal->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('terminal_user') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="sm:col-span-3" x-data="{ open: false }">
                    <label class="block text-sm/6 font-medium text-white">Roles</label>
                    
                    <div class="relative mt-2 @click.away="open = false">
                        <button 
                            @click="open = !open" 
                            type="button" 
                            class="w-full flex items-center justify-between bg-zinc-800 border border-zinc-500 rounded-lg px-4 py-1.5 text-left text-gray-300 hover:border-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all"
                        >
                            <span class="truncate">
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
                            <div class="p-2 space-y-1 max-h-60 overflow-y-auto custom-scrollbar">
                                @foreach($roles as $role)
                                    <label class="flex items-center px-3 py-2 hover:bg-zinc-800 rounded-md cursor-pointer group transition-colors">
                                        <input 
                                            type="checkbox" 
                                            value="{{ $role->name }}" 
                                            wire:model.live="selectedRoles" 
                                            id="role_{{ $role->id }}"
                                            class="w-4 h-4 rounded border-zinc-600 bg-zinc-800 text-blue-600 focus:ring-blue-500 focus:ring-offset-zinc-900"
                                        >
                                        <span class="ml-3 text-sm text-gray-300 group-hover:text-white">
                                            {{ $role->name }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6 px-6">
            <a href="{{ route('users.index') }}" class="text-sm/6 font-semibold text-white">Cancelar</a>
            <button type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Guardar</button>
        </div>
    </div>
</form>
