@props(['name' => ''])

@php
    // Si hay un nombre y hay un error para ese nombre, activamos el estilo de error
    $hasError = $name && $errors->has($name);
    
    // Clases dinámicas según si hay error o no
    $statusClasses = $hasError 
        ? "border-red-500 focus:border-red-500 focus:ring-red-500" 
        : "focus:border-indigo-500 focus:ring-indigo-500";
@endphp

<select name="{{ $name }}" {{ $attributes->merge(['class' => "col-start-1 row-start-1 w-full appearance-none rounded-md bg-white/5 dark:bg-zinc-800 py-1.5 pr-8 pl-3 text-base text-gray-800 dark:text-white outline-1 -outline-offset-1 outline-white/10 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6 custom-scrollbar $statusClasses"]) }}>
    {{ $slot }}
</select>

@if($name)
    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
@endif