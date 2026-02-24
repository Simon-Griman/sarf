@props([
    'icon' => 'success',
    'title' => '¡Hecho!',
    'session' => 'success'
])

@if(session()->has($session))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const isDark = document.documentElement.classList.contains('dark');
            
            window.Swal.fire({
                title: "{{ $title }}",
                text: "{{ session($session) }}",
                icon: "{{ $icon }}",
                toast: true,
                //position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: isDark ? '#1f2937' : '#ffffff',
                color: isDark ? '#ffffff' : '#1f2937',
                iconColor: "{{ $icon === 'success' ? '#10b981' : '' }}", 
            });
        });
    </script>
@endif