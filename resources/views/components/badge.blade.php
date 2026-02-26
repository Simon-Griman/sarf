@props(['name'])

@php
    $classes = match (strtolower($name)) {
        'super-admin' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
        'admin'       => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
        'user'        => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
        'invitado'    => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
        default       => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
    };
@endphp

<span class="{{ $classes }} text-xs font-medium me-2 px-2.5 py-0.5 rounded">
    {{ $slot }}
</span>