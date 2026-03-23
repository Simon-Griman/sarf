<x-app-layout>
    <x-slot name="title">Roles</x-slot>

    <x-swal-toast />

    <x-card>
        <x-primary-button onclick="window.location.href='{{ route('roles.create') }}'" class="mb-4">Crear Rol</x-primary-button>

        <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-zinc-700 text-left font-medium tracking-wider">Nombre</th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-zinc-700 text-left font-medium tracking-wider">Peso</th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-zinc-700 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                @foreach($roles as $role)
                    @if ($role->peso <= auth()->user()->roles->max('peso'))
                    <tr class="hover:bg-gray-100 dark:hover:bg-zinc-700">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $role->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $role->peso }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <x-edit-button onclick="window.location.href='{{ route('roles.edit', $role->id) }}'"><i class="fas fa-pen-to-square"></i> Editar</x-edit-button>
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este rol?');">
                                @csrf
                                @method('DELETE')
                                <x-delete-button><i class="fas fa-trash"></i> Borrar</x-delete-button>
                            </form>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </x-card>
</x-app-layout>