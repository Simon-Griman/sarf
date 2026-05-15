<div class="m-0 p-0">
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        ¿Olvidó su contraseña? No hay problema. Simplemente déjenos saber su dirección de correo electrónico y le enviaremos una notificación a los administradores para que puedan reestablecer su contraseña.
    </div>

    <form wire:submit.prevent="submit">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus wire:model="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">

            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4" href="{{ route('login') }}">
                Log In
            </a>

            <x-primary-button>
                Enviar solicitud
            </x-primary-button>
        </div>
    </form> 
</div>
