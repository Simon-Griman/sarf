@props([
    'title' => null,
])

{{-- Definimos los tipos de alerta que queremos escuchar --}}
@php
    $types = ['success', 'error', 'info', 'warning', 'question'];
    $activeType = collect($types)->first(fn($type) => session()->has($type));
@endphp

@if($activeType)
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const isDark = document.documentElement.classList.contains('dark');
            
            // Mapeo de colores para los iconos (opcional)
            const iconColors = {
                success: '#10b981',
                error: '#ef4444',
                warning: '#f59e0b',
                info: '#3b82f6'
            };

            window.Swal.fire({
                title: "{{ $title ?? ($activeType === 'success' ? '¡Hecho!' : 'Atención') }}",
                text: "{{ session($activeType) }}",
                icon: "{{ $activeType }}",
                toast: true,
                //position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: isDark ? '#1f2937' : '#ffffff',
                color: isDark ? '#ffffff' : '#1f2937',
                iconColor: iconColors["{{ $activeType }}"] || '',
            });
        });
    </script>
@endif