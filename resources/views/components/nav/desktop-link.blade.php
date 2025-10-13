@props([
  'active' => false
])

@php
  $activeClass = $active ? 'font-medium text-gray-700 dark:text-white' : 'font-normal text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-100';

  $classes = 'px-3 py-2 text-sm lg:text-base ' . $activeClass;
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
  {{ $slot }}
</a>