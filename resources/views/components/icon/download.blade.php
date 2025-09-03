@props([
  'class' => 'w-5 h-5',
  'stroke' => 2,
  'color' => 'currentColor'
])

<svg 
  {{ $attributes->merge(['class' => $class]) }} 
  stroke="{{ $color }}"
  stroke-width="{{ $stroke }}"
  fill="none"
  viewBox="0 0 24 24"
>
  <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
</svg>

