<div>
    <x-card>
        <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-zinc-700 text-left font-medium tracking-wider">Nombre</th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-zinc-700 text-left font-medium tracking-wider">Fecha de Solicitud</th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-zinc-700 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                @foreach($users as $user)
                    <tr class="hover:bg-gray-100 dark:hover:bg-zinc-700">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->reset_password_sent_at }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <x-edit-button class="text-amber-600 dark:text-amber-500 hover:text-amber-500 dark:hover:text-amber-400" wire:click="resetPass({{ $user->id }})"><i class="fas fa-key"></i> Resetear</x-edit-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-card>
</div>
