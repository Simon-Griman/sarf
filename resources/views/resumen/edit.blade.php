<x-app-layout>
    <x-slot name="title">Resumen</x-slot>

    @livewire('resumen.edit', ['resumen_id' => $id])
</x-app-layout>