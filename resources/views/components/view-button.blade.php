<button {{ $attributes->merge(['type' => 'button', 'class' => 'text-green-700 dark:text-green-500 cursor-pointer hover:underline decoration-2 hover:text-green-900 dark:hover:text-green-400 pr-2']) }}>
    {{ $slot }}
</button>