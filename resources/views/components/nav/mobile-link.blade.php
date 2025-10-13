@props([
  'active' => false
])

@php
  $activeClass = $active ? 'font-medium bg-gray-200 dark:bg-slate-700' : '';

  $classes = 'px-3 py-2 rounded-md text-gray-600 dark:text-white hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors block ' . $activeClass;
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
  {{ $slot }}
</a>