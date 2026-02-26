@props([
    'name' => '',
    'type' => 'text',
    'value' => '',
])

@php
    // Si hay un nombre y hay un error para ese nombre, activamos el estilo de error
    $hasError = $name && $errors->has($name);
    
    // Clases dinámicas según si hay error o no
    $statusClasses = $hasError 
        ? "border-red-500 focus:border-red-500 focus:ring-red-500" 
        : "focus:border-indigo-500 focus:ring-indigo-500";
@endphp

<input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" autocomplete="given-name" {{ $attributes->merge(['class' => "block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-gray-800 dark:text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6 $statusClasses"]) }}/>

@if($name)
    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
@endif