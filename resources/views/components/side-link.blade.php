@props(['active' => false])
<a wire:navigate {{ $attributes->merge(['class' => ($active 
    ? ' bg-gray-100 dark:bg-gray-700 dark:text-white shadow-[inset_0_4px_6px_rgba(0,0,0,0.1)]' 
    : 'dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group') . ' flex items-center p-2 text-base font-medium text-gray-900 rounded-lg']) }}>
    {{ $slot }}
</a>