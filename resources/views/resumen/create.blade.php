<x-app-layout>
    <x-slot name="title">Resumen</x-slot>

    @livewire('resumen.create', ['tipo_operacion' => $operacion ?? null])
</x-app-layout>