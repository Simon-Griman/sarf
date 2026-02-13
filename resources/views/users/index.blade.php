<x-app-layout>

    <x-slot name="title">Usuarios</x-slot>

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

    @livewire('users.index')

</x-app-layout>