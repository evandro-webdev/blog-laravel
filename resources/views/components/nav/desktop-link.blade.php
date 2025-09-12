@props(['active' => false])

<a {{ $attributes->class([
    'px-3 py-2 text-sm text-gray-700 dark:text-white',
    'font-bold' => $active,
    'font-medium' => !$active
]) }}
    {{ $active ? 'aria-current="page"' : '' }}
>
    {{ $slot }}
</a>