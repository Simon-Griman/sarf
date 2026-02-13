<form wire:submit.prevent="update">
    <div class="space-y-12 sm:px-6">
        <div class="border-b border-white/10 pb-12">
            <h2 class=" text-xl font-semibold text-white">Información del Usuario</h2>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="first-name" class="block text-sm/6 font-medium text-white">Nombre</label>
                    <div class="mt-2">
                        <input id="first-name" type="text" name="first-name" autocomplete="given-name" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" wire:model="nombre" />
                    </div>
                    @error('nombre') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="sm:col-span-3">
                    <label for="last-name" class="block text-sm/6 font-medium text-white">Cedula</label>
                    <div class="mt-2">
                        <input id="last-name" type="text" name="last-name" autocomplete="family-name" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" wire:model="cedula" />
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="email" class="block text-sm/6 font-medium text-white">Correo Electrónico</label>
                    <div class="mt-2">
                        <input id="email" type="email" name="email" autocomplete="email" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" wire:model="correo" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="country" class="block text-sm/6 font-medium text-white">Terminal de Origen</label>
                    <div class="mt-2 grid grid-cols-1">
                        <select id="country" name="country" autocomplete="country-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white/5 py-1.5 pr-8 pl-3 text-base text-white outline-1 -outline-offset-1 outline-white/10 *:bg-gray-800 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" wire:model="terminal_user">
                            @foreach ($terminales as $terminal)
                                <option value="{{ $terminal->id }}">{{ $terminal->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="country" class="block text-sm/6 font-medium text-white">Roles <span class="text-red-500">(Sin desarrollar)</span></label>
                    <div class="mt-2 grid grid-cols-1">
                        <select id="country" name="country" autocomplete="country-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white/5 py-1.5 pr-8 pl-3 text-base text-white outline-1 -outline-offset-1 outline-white/10 *:bg-gray-800 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6">
                            <option>Cosita</option>
                            <option>Rola</option>
                            <option>Peine</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6 px-6">
        <button type="button" class="text-sm/6 font-semibold text-white">Cancelar</button>
        <button type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Guardar</button>
    </div>
</form>
