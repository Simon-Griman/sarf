<button {{ $attributes->merge(['type' => 'button', 'class' => 'text-blue-700 dark:text-blue-500 cursor-pointer hover:underline decoration-2 hover:text-blue-900 dark:hover:text-blue-400 pr-2']) }}>
    {{ $slot }}
</button>