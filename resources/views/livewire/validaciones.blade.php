<div class="p-6 rounded-xl shadow bg-white dark:bg-zinc-800">
    <div class="mb-4 flex space-x-2">
        <button 
            type="button" 
            wire:click="checkAll" 
            class="px-3 py-1.5 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition"
        >
            🗹 Marcar todos
        </button>

        <button 
            type="button" 
            wire:click="uncheckAll" 
            class="px-3 py-1.5 bg-gray-500 text-white text-sm rounded hover:bg-gray-600 transition"
        >
            ☐ Desmarcar todos
        </button>
    </div>
    <table class="table-auto w-full text-left border-collapse">
        <thead>
            <tr class="border-b">
                <th class="pb-2">Nombre del Campo</th>
                <th class="pb-2">¿Es Obligatorio?</th>
            </tr>
        </thead>
        <tbody>
            @foreach($validaciones as $validacion)
                <tr class="border-b hover:bg-zinc-100 dark:hover:bg-zinc-700">
                    <td class="py-3 font-medium">
                        {{ ucfirst($validacion->field_name) }}
                    </td>
                    <td class="py-3">
                        <input 
                            type="checkbox" 
                            wire:model.live="settings.{{ $validacion->id }}"
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                        >
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>