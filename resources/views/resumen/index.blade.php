<x-app-layout>

    <x-slot name="title">Resumen</x-slot>

    <!--TODO: cambiar los session por componentes-->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const isDark = document.documentElement.classList.contains('dark');
                
                Swal.fire({
                    title: '¡Hecho!',
                    text: "{{ session('success') }}", // Aquí tomamos el mensaje de la sesión
                    icon: 'success',
                    toast: true,
                    //position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: isDark ? '#1f2937' : '#ffffff',
                    color: isDark ? '#ffffff' : '#1f2937',
                });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const isDark = document.documentElement.classList.contains('dark');
                
                Swal.fire({
                    title: '¡Error!',
                    text: "{{ session('error') }}", // Aquí tomamos el mensaje de la sesión
                    icon: 'error',
                    toast: true,
                    //position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: isDark ? '#1f2937' : '#ffffff',
                    color: isDark ? '#ffffff' : '#1f2937',
                });
            });
        </script>
    @endif

    @livewire('resumen.index')

</x-app-layout>