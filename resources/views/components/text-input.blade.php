@props([
    'name' => null, 
    'type' => 'text', 
    'value' => ''
])

@php
    // Si hay un nombre y hay un error para ese nombre, activamos el estilo de error
    $hasError = $name && $errors->has($name);
    
    // Clases base (puedes ajustarlas a tu diseño)
    $baseClasses = "w-full md:w-3/4 bg-zinc-100 dark:bg-zinc-900 rounded-md shadow-sm border transition duration-150 ease-in-out";
    
    // Clases dinámicas según si hay error o no
    $statusClasses = $hasError 
        ? "border-red-500 text-red-900 focus:border-red-500 focus:ring-red-500" 
        : "border-zinc-300 dark:border-zinc-700 focus:border-indigo-500 focus:ring-indigo-500";
@endphp

<div class="w-full">
    <input 
        type="{{ $type }}"
        @if($name) name="{{ $name }}" @endif
        {{-- Si hay name, usamos old() para persistencia; si no, el value normal --}}
        value="{{ $name ? old($name, $value) : $value }}"
        {{-- Mezclamos las clases calculadas con cualquier otra clase que pases desde fuera --}}
        {{ $attributes->merge(['class' => "$baseClasses $statusClasses"]) }}
    >

    {{-- Mostramos el mensaje de error solo si el name existe y tiene errores --}}
    @if($name)
        @error($name)
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    @endif
</div>