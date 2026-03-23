<x-app-layout>
    <x-slot name="title">Roles</x-slot>

    <x-h2>Crear Rol</x-h2>

    <x-card>
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label class="block pb-2">Nombre del Rol:</label>
                    <x-text-input type="text" name="name" value="{{ old('name') }}" placeholder="Nombre del rol"></x-text-input>
                </div>
                <div class="sm:col-span-3 mb-4">
                    <label class="block pb-2">Peso del Rol:</label>
                    <x-text-input type="number" name="peso" value="{{ old('peso') }}" placeholder="Peso del rol"></x-text-input>
                </div>
            </div>

            <h3 class="mt-3 mb-2">Asignar Permisos</h3>
            <div class="row overflow-y-auto px-2 pb-2 custom-scrollbar" style="height: 44vh;">
                @foreach($permissions as $permission)
                    <div class="col-md-3">
                        <label>
                            <x-checkbox name="permissions[]" value="{{ $permission->name }}"
                                :checked="old('permissions') && in_array($permission->name, old('permissions'))"></x-checkbox>
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <x-primary-button class="mt-4 mr-4">Crear Rol</x-primary-button>
            <x-secondary-button onclick="window.location.href='{{ route('roles.index') }}'">Cancelar</x-secondary-button>
        </form>
    </x-card>
</x-app-layout>