<x-app-layout>

    <x-slot name="title">Usuarios</x-slot>

    @livewire('users.edit', ['user_id' => $id])

</x-app-layout>