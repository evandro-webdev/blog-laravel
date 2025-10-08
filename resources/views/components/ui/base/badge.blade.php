@props([
  'pill' => true, 
  'small' => false, 
  'href' => null,
  'variant' => 'default'
])

@php
  $classes = 'max-w-max font-medium inline-block shrink-0 transition-colors';

  $classes .= $pill ? ' rounded-full' : ' rounded-sm';
  $classes .= $small ? ' px-3 py-1 text-xs' : ' px-4 py-2 text-sm';
  
  switch ($variant) {
    case 'blue':
      $style = ' text-white bg-blue-600 hover:bg-blue-700';
      break;

    case 'white':
      $style = ' text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600';
      break;

    default:
      $style = ' text-blue-500 dark:text-blue-300 bg-blue-50 dark:bg-blue-900 hover:bg-blue-100 dark:hover:bg-blue-950 ';
      break;
  }

  $classes .= $style;
@endphp

@if($href)
  <a {{ $attributes->merge(['class' => $classes . 'cursor-pointer', 'href' => $href]) }}>
    {{ $slot }}
  </a>
@else
  <span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
  </span>
@endif