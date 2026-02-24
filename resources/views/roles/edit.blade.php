<x-app-layout>
    <x-slot name="title">Roles</x-slot>

    <x-h2>Editar Rol</x-h2>

    <x-card>
        <form action="{{ route('roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="block pb-2">Nombre del Rol:</label>
                <x-text-input type="text" name="name" value="{{ $role->name }}" class="w-full md:w-3/4"></x-text-input>
            </div>

            <h3 class="mt-3 mb-2">Asignar Permisos</h3>
            <div class="row overflow-y-auto px-2 pb-2" style="max-height: 300px;">
                @foreach($permissions as $permission)
                    <div class="col-md-3">
                        <label>
                            <x-checkbox name="permissions[]" value="{{ $permission->name }}"
                                :checked="$role->hasPermissionTo($permission->name)"></x-checkbox>
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <x-primary-button class="mt-4 mr-4">Actualizar Rol</x-primary-button>
            <x-secondary-button onclick="window.location.href='{{ route('roles.index') }}'">Cancelar</x-secondary-button>
        </form>
    </x-card>            
</x-app-layout>