@props([
  'size' => 'w-5 h-5',
  'stroke' => 1.5,
  'class' => ''
])

@php
  $classes = trim($size . ' ' . $class);
@endphp

<svg
  {{ $attributes->merge(['class' => $classes]) }}
  stroke="currentColor"
  stroke-width="{{ $stroke }}"
  fill="none"
  viewBox="0 0 24 24"
>
  {{ $slot }}
</svg>