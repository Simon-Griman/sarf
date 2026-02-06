<x-table>
    <x-slot name="thead">
        <th class="px-4 py-3.5 text-sm font-medium text-left text-gray-500 dark:text-gray-400">Usuario</th>
        <th class="px-4 py-3.5 text-sm font-medium text-left text-gray-500 dark:text-gray-400">Estado</th>
        <th class="px-4 py-3.5 text-sm font-medium text-left text-gray-500 dark:text-gray-400">Rol</th>
        <th class="relative py-3.5 px-4">
            <span class="sr-only">Acciones</span>
        </th>
    </x-slot>

    @foreach($users as $user)
        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors duration-200">
            <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                <div class="flex items-center gap-x-3">
                    <img class="object-cover w-10 h-10 rounded-full" src="{{ $user->avatar_url }}" alt="">
                    <div>
                        <h2 class="font-medium text-gray-800 dark:text-white ">{{ $user->name }}</h2>
                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                    </div>
                </div>
            </td>
            <td class="px-4 py-4 text-sm whitespace-nowrap">
                <span class="px-3 py-1 text-xs text-indigo-500 rounded-full bg-indigo-100/60 dark:bg-gray-800">
                    Activo
                </span>
            </td>
            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                Admin
            </td>
            <td class="px-4 py-4 text-sm whitespace-nowrap">
                <button class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-400 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                    </svg>
                </button>
            </td>
        </tr>
    @endforeach
</x-table>