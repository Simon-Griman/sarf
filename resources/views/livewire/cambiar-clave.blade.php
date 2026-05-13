<div>
    <form wire:submit.prevent="changePass">
        @csrf

        <!-- Password -->
        <div class="mt-2">
            
            <x-input-label for="password" :value="__('Nueva Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" 
                            wire:model="password"/>

            <br>            
            <x-input-label for="confirPass" :value="__('Confirmar Contraseña')" />
            <x-text-input id="confirPass" class="block mt-1 w-full"
                            type="password"
                            name="confirPass"
                            required autocomplete="current-password" 
                            wire:model="confirPass"/>
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="ms-3">
                Actualizar Contraseña
            </x-primary-button>
        </div>
    </form>
</div>  