@props([
    'name', 
    'value' => '', 
    'checked' => false
])

<input 
    type="checkbox" 
    name="{{ $name }}" 
    value="{{ $value }}"
    {{ $checked ? 'checked' : '' }}
    {{ $attributes->merge([
        'class' => 'rounded border-zinc-600 bg-zinc-100 dark:bg-zinc-900 text-blue-600 dark:text-blue-600 mr-3 transition focus:ring-blue-500'
    ]) }}
>