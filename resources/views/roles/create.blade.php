<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Nombre del Rol:</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        </div>

                        <h3 class="mt-3">Asignar Permisos</h3>
                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-md-3">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            {{ old('permissions') && in_array($permission->name, old('permissions')) ? 'checked' : '' }}>
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Crear Rol</button>
                        <button type="button" onclick="window.location.href='{{ route('roles.index') }}'" class="btn btn-secondary mt-4 ml-2">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>