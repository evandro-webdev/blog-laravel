@props([
  'pill' => true, 
  'small' => false, 
  'href' => null,
  'variant' => 'default'
])

@php
  $baseClasses = 'inline-block max-w-max font-medium shrink-0 transition-colors';

  $roundedClass = $pill
    ? 'rounded-full'
    : 'rounded-sm';

  $sizeClass = $small
    ? 'px-3 py-1 text-xs'
    : 'px-4 py-2 text-sm';

  $variantClasses = [
    'default' => 'text-blue-500 dark:text-blue-300 bg-blue-50 dark:bg-blue-900 hover:bg-blue-100 dark:hover:bg-blue-800',
    'blue' => 'text-white bg-blue-600 hover:bg-blue-700',
    'white' => 'text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-slate-700 hover:bg-gray-200 dark:hover:bg-slate-600'
  ];

  $classes = implode(' ', [$baseClasses, $roundedClass, $sizeClass, $variantClasses[$variant]]);
@endphp

@if($href)
  <a {{ $attributes->merge(['class' => $classes . ' cursor-pointer ', 'href' => $href]) }}>
    {{ $slot }}
  </a>
@else
  <span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
  </span>
@endif