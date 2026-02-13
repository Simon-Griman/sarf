<form wire:submit.prevent="update">
    <div class="space-y-12 sm:px-6">
        <div class="border-b border-white/10 pb-12">
            <h2 class=" text-xl font-semibold text-white">Información del Usuario</h2>

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

                <div class="sm:col-span-3">
                    <label for="rol" class="block text-sm/6 font-medium text-white">Roles <span class="text-red-500">(Sin desarrollar)</span></label>
                    <div class="mt-2 grid grid-cols-1">
                        <select id="rol" name="rol" autocomplete="rol" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white/5 py-1.5 pr-8 pl-3 text-base text-white outline-1 -outline-offset-1 outline-white/10 *:bg-gray-800 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6">
                            <option>Cosita</option>
                            <option>Rola</option>
                            <option>Peine</option>
                        </select>
                    </div>
                    @error('rol') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6 px-6">
        <a href="{{ route('users.index') }}" class="text-sm/6 font-semibold text-white">Cancelar</a>
        <button type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Guardar</button>
    </div>
</form>
