<x-app-layout>

    <x-slot name="title">Resumen</x-slot>

    <!--TODO: cambiar los session por componentes-->
    <x-swal-toast/>

    @livewire('resumen.index')

</x-app-layout>