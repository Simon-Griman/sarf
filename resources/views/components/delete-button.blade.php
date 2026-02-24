<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-red-700 dark:text-red-500 cursor-pointer hover:underline decoration-2 hover:text-red-900 dark:hover:text-red-400 pl-2']) }}>
    {{ $slot }}
</button>